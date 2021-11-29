<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Models\ApiResponseOrder;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Objects\PaymentGateway;
use App\Traits\CarTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    use CarTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('details')->get();
        $title = 'Pedidos Registrados';
        $type_view = true;

        return view('orders.index', compact('orders', 'title', 'type_view'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myOrders()
    {
        $orders = Order::with('details')->where('customer_email', Auth()->user()->email)->get();
        $title = 'Mis Pedidos';
        $type_view = false;

        return view('orders.index', compact('orders', 'title', 'type_view'));
    }

    /**
     * Set order
     * @param Illuminate\Http\Request $request
     */
    public function order(Request $request)
    {
        $data = $this->getProductsOnShoppingCart();
        $subtotal = 0;
        $discount = 0;
        $total = 0;

        if (Auth::check()) {
            $request->merge([
                'customer_name' => auth()->user()->name,
                'customer_email' => auth()->user()->email,
                'customer_mobile' => auth()->user()->phone,
                'status' => 'CREATED',
                'detail' => $data
            ]);

            $order = $this->store(StoreOrderRequest::createFromBase($request));
            Session::put('order', $order->id);
        }

        foreach ($data as $sku => $quantity_product) {
            $product = Product::where('sku', $sku)->get()[0];
            $data[$sku] = array($quantity_product, $product);
            $subtotal += $quantity_product * $product->price;
            $discount += ($quantity_product * $product->price) * ($product->discount / 100);
            $total += ($quantity_product * $product->price) - (($quantity_product * $product->price) * ($product->discount / 100));
        }

        Session::put('detail', $data);
        Session::put('subtotal', $subtotal);
        Session::put('discount', $discount);
        Session::put('total', $total);
        return redirect(route('orderfirststep'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());

        foreach ($request->detail as $key => $amount) {
            $product = Product::where('sku', $key)->get()[0];
            $detail = new OrderDetail();
            $detail->sku = $key;
            $detail->amount = $amount;
            $detail->price = $product->price;
            $detail->discount = $product->discount;
            $detail->order_id = $order->id;
            $detail->save();
        }

        Cache::flush();
        return $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderFirstStep()
    {
        $detail = Session::get('detail');
        $order = Session::get('order');
        $subtotal = Session::get('subtotal');
        $discount = Session::get('discount');
        $total = Session::get('total');
        return view('orders.order', compact('detail', 'order', 'subtotal', 'discount', 'total'));
    }

    /**
     * Display a listing of the resource.
     * @param App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function getOrderFirstStep(Order $order)
    {
        $info = $this->assembleDetail($order);
        $detail = $info[0];
        $subtotal = $info[1];
        $discount = $info[2];
        $total = $info[3];
        $order = $order->id;
        return view('orders.order', compact('detail', 'order', 'subtotal', 'discount', 'total'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $info = $this->assembleDetail($order);
        $detail = $info[0];
        $subtotal = $info[1];
        $discount = $info[2];
        $total = $info[3];
        $order = $order;
        return view('orders.show', compact('detail', 'order', 'subtotal', 'discount', 'total'));
    }

    /**
     * Armar la información de la orden de pedido
     * @param App\Models\Order $order
     */
    private function assembleDetail(Order $order)
    {
        $details = $order->details()->select([
            'id',
            'sku',
            'amount',
            'price',
            'discount',
            'order_id'
        ])->get();

        $subtotal = 0;
        $discount = 0;
        $total = 0;
        $detail = array();

        foreach ($details as $value) {
            $product = Product::where('sku', $value->sku)->get()[0];
            $product->price = $value->price;
            $product->discount = $value->discount;

            $detail[$value->sku] = array($value->amount, $product);
            $subtotal += $value->amount * $value->price;
            $discount += ($value->amount * $value->price) * ($value->discount / 100);
            $total += ($value->amount * $value->price) - (($value->amount * $value->price) * ($value->discount / 100));
        }

        return array($detail, $subtotal, $discount, $total);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $message = 'La orden N° "' .  $order->id . '" ha sido eliminada correctamente.';
        $order->delete();

        return back()->withStatus(__($message));
    }

    /**
     * Procesar el pago con la pasarela de pago
     * @param Illuminate\Http\Request $request
     */
    public function payment(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
            'order' => ['required', 'integer'],
        ]);

        $order_pending = ApiResponseOrder::where('order_id', $request->order)->where('status', 'PENDING')->get();
        $placetopay = new PaymentGateway();

        if (count($order_pending) == 0) {
            $reference = $request->order;
            $request_api = [
                'payment' => [
                    'reference' => $reference,
                    'description' => 'Testing payment',
                    'amount' => [
                        'currency' => $request->currency,
                        'total' => $request->amount,
                    ],
                ],
                'expiration' => date('c', strtotime('+1 days')),
                'returnUrl' => 'http://localhost:8000/payment/' . $reference,
                'ipAddress' => '127.0.0.1',
                'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
            ];

            $response = $placetopay->getPlaceToPay()->request($request_api);

            if ($response->isSuccessful()) {
                // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
                // Redirect the client to the processUrl or display it on the JS extension
                $api_response = new ApiResponseOrder();
                $api_response->order_id = $request->order;
                $api_response->request_id = $response->requestId();
                $api_response->process_url = $response->processUrl();
                $api_response->status = 'PENDING';
                $api_response->save();

                return redirect()->to($response->processUrl());
            } else {
                // There was some error so check the message and log it
                return back()->withStatus($response->status()->message());
            }
        } else {
            $response = $placetopay->getPlaceToPay()->query($order_pending[0]->request_id);

            if ($response->isSuccessful()) {
                if ($response->status()->isApproved()) {
                    return redirect(route('payment.approved'));
                }

                if (in_array($response->status()->status(), ['REJECTED', 'PENDING'])) {
                    if ($response->status()->status() == 'REJECTED') {
                        $order_pending[0]->status = $response->status()->status();
                        $order_pending[0]->update();
                        $order_pending[0] = $order_pending[0];
                    }

                    return redirect(route('orderfirststep.option', ['order' => $request->order]))
                        ->withStatus($response->status()->message() . "\n");
                }
            } else {
                // There was some error with the connection so check the message
                return back()->withStatus($response->status()->message() . "\n");
            }
        }
    }

    /**
     * Retorno de la pasarela de pago
     * @param Illuminate\Http\Request $request
     */
    public function returnUrl(Request $request, $reference)
    {
        $placetopay = new PaymentGateway();
        $order_pending = ApiResponseOrder::where('order_id', $reference)->get();
        $response = $placetopay->getPlaceToPay()->query($order_pending[0]->request_id);

        if ($response->isSuccessful()) {
            if ($response->status()->isApproved()) {
                return redirect(route('payment.approved'));
            }

            if (in_array($response->status()->status(), ['REJECTED', 'PENDING'])) {
                if ($response->status()->status() == 'REJECTED') {
                    $order_pending[0]->status = $response->status()->status();
                    $order_pending[0]->update();
                    $order_pending[0] = $order_pending[0];
                }

                return redirect(route('orderfirststep.option', ['order' => $reference]))
                    ->withStatus($response->status()->message() . "\n");
            }
        } else {
            // There was some error with the connection so check the message
            return back()->withStatus($response->status()->message() . "\n");
        }
    }

    /**
     * Retorno de la pasarela de pago a la vista de aprobación de pago
     * @param Illuminate\Http\Request $request
     */
    public function paymentApproved(Request $request, $reference)
    {
        $order_pending = ApiResponseOrder::where('order_id', $reference)->get();
        $order_pending[0]->status = 'PAYED';
        $order_pending[0]->save();

        $order = $order_pending->order()->get();
        $order[0]->status = 'PAYED';
        $order[0]->save();

        $info = $this->assembleDetail($order[0]);
        $detail = $info[0];
        $subtotal = $info[1];
        $discount = $info[2];
        $total = $info[3];
        $order = $order;
        return view('orders.approved', compact('detail', 'order', 'subtotal', 'discount', 'total'));
    }
}
