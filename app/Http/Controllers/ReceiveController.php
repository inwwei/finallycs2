<?php

namespace App\Http\Controllers;

use App\Models\Orders\OrderDetail;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderDetail(Request $request, $id)
    {
        $type = $request->product_type['title'];

        $data = OrderDetail::with('settingMasterProduct', 'order')
            ->where('type', 'สั่ง')->whereHas('order', function ($query_order) use ($id) {
            $query_order->where('partner_id', $id)->where('status', 'ยืนยัน');
        })
            ->whereHas('settingMasterProduct', function ($query_settingMasterProduct) use ($type) {
                $query_settingMasterProduct->where('type', $type);
            })->get();
        return response()->success($data, [], '0', 200);
    }

    public function getOrderDetailSucces()
    {

        $data = Product::with('settingMasterProduct')
            ->where('type_received', '!=', 'เพิ่ม')->get();
        return response()->success($data, [], '0', 200);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $shipping_price = $id;
        // return $shipping_price+1;

        $datas_validate = $request->validate([ //ตรวจสอบค่า

            '*.id' => 'required',
            '*.setting_master_product_id' => 'required',
            '*.vin' => 'sometimes',
            '*.branch.id' => 'sometimes',
            '*.tags' => 'sometimes',
            '*.description' => 'required',
            '*.setting_master_product.type' => 'sometimes',
            '*.setting_master_product.retail_price' => 'required',
            '*.wholesale_price' => 'required',
            '*.cost_price' => 'required',
            '*.shipping_price' => 'sometimes',
            '*.new_amount_recieve' => 'sometimes',
            '*.date' => 'sometimes',
            '*.type' => 'sometimes',
            '*.new_amount_recieve' => 'sometimes',
            '*.quantity' => 'required',
            '*.received_date' => 'required',

        ]);

        if (isset($datas_validate)) {
            $products = $datas_validate;
            foreach ($products as $index => $product) {//ลูปสร้าง

                $product['setting_basic_branch_id'] = $product['branch']['id']; //สร้าง setting_basic_branch_id เพราะมันไม่ได้ส่งมาเป็นตัวแปลนี้ตรง ๆ จำเป็นต้องแปลง
                $product['type'] = $product['setting_master_product']['type'];  //สร้าง type เพราะมันไม่ได้ส่งมาเป็นตัวแปลนี้ตรง ๆ จำเป็นต้องแปลง
                $product['retail_price'] = $product['setting_master_product']['retail_price']; //สร้าง retail_price เพราะมันไม่ได้ส่งมาเป็นตัวแปลนี้ตรง ๆ จำเป็นต้องแปลง

                if ($product['type'] == 'อะไหล่') { //ตรวจสอบว่า สินค้านี้ใช่ อะไหล่ หรือ ไม่ ?
                    $product['quantity'] = $product['new_amount_recieve']; //แปลงตัวแปล กรณีเพิ่มใหม่ filed ใน migrate  มันต้องใส่เป็น quantity
                    $find_id_product = Product::where('setting_master_product_id', $product['setting_master_product_id'])->first(); //query ดูว่าเคยเพิ่มหรือยัง

                    if ($find_id_product) { //เช็คว่ามีหรือยัง
                        if ($shipping_price == 0) { //เช็ควว่ามีค่าใช้จ่ายหรือไม่
                            $Old_cost = $find_id_product->quantity * $find_id_product->wholesale_price; //คำนวณหา ต้นทุนเก่า
                            $new_cost = $product['new_amount_recieve'] * $product['cost_price']; //คำนวณหา ต้นทุนใหม่
                            $total = ($new_cost + $Old_cost) / ($find_id_product->quantity + $product['new_amount_recieve']); //คำนวณหา ราคาทุนโดยเฉลี่ย
                            $find_id_product->wholesale_price = $total; //ย้ายค่าไปใส่ตัวแปร เพื่อปรับwholesale_price ใน row เดิม
                            $find_id_product->quantity = $find_id_product->quantity + $product['quantity']; //ย้ายค่าไปใส่ตัวแปร เพื่อเพิ่มจำนวนใน row เดิม
                            $find_id_product->retail_price = $product['retail_price']; //ย้ายค่าตัวแปร เพื่อ
                            $find_id_product->save();
                        } else { //กรณีมีค่าใช้จ่าย
                            $Old_cost = $find_id_product->quantity * $find_id_product->wholesale_price; //คำนวณหา ต้นทุนเก่า
                            $new_cost = $product['new_amount_recieve'] * $product['cost_price']; //คำนวณหา ต้นทุนใหม่
                            $total = ($Old_cost + $new_cost) / $shipping_price;  //คำนวณหา ต้นทุนใหม่ โดยมีค่าใช้จ่ายมาคำนวณด้วย
                            $find_id_product->wholesale_price = $total; //$total จะกลายเป็นราคาทุน
                            $find_id_product->retail_price = $product['retail_price'];//ย้ายค่าสของตัวแปร
                            $find_id_product->quantity = $find_id_product->quantity + $product['quantity']; //เมื่อมีการเพิ่ม โดยมีสินค้าอยู่ก่อนหน้าแล้ว สิ่งจะบรรทัดนี้ทำคือ จำนวนเก่า+จำนวนใหม่
                            $find_id_product->save();
                        }
                    } else {
                        $product['retail_price'] = $product['setting_master_product']['retail_price']; //ย้ายค่าตัวแปร
                        Product::create($product); //สร้างใหม่กรณี ยังไม่เคยมี
                    }

                    $OrderDetail = OrderDetail::find($product['id']); //หารายการสั่ง เพื่อจะได้เอาไว้อัพเดทรายการสั่งว่้าสั่งไปกี่ชิ้นแล้ว ราคาชิ้นละเท่าไหร่
                    $OrderDetail->retail_price = $product['setting_master_product']['retail_price'];
                    $OrderDetail->amount = $OrderDetail->amount - $product['new_amount_recieve']; //ตรวจสอบการรับ ว่าจำนวนที่รับ รับครบตามที่สั่งหรือยัง จำนวนที่รับมา

                    if ($OrderDetail->amount <= 0) {
                        $OrderDetail->type = 'รับ'; //ถ้าจำนวนที่รับเป็น 0 แสดงว่ารับครบแล้ว สถานะจะเปลี่ยน เพราะตอนดึง จะดึงตัวที่สถานะยังเป็นสั่งอยู่ ซึ่งหมายความว่ายังรับไม่ครบยอดอที่สั่ง
                    }

                    $OrderDetail->vin = $product['vin']; //ย้ายค่าตัวแปร
                    $OrderDetail->amount_recieve = $OrderDetail->amount_recieve + $product['new_amount_recieve']; //อัพเดทจำนวนที่รับมา ลงฐานข้อมูล
                    $OrderDetail->description = $product['description']; //ย้ายค่าตัวแปร
                    $result = $OrderDetail->save();

                } else { //กรณีไม่ใช่อะไหล่ (รถ ต่ออพ่วง)
                    if ($shipping_price != 0) {
                        $product['wholesale_price'] = $product['cost_price'] + $shipping_price; //หาราคาทุน
                    } else {
                        $product['wholesale_price'] = $product['cost_price']; //หาราคาทุน
                    }

                    Product::create($product); //สร้างสินค้าใหม่
                    $OrderDetail = OrderDetail::find($product['id']);
                    $OrderDetail->retail_price = $product['setting_master_product']['retail_price'];
                    $product['new_amount_recieve'] = 1; //รถ ต่อพ่วง รับทีละ 1 ชิ้นเสมอ
                    $OrderDetail->amount = $OrderDetail->amount - $product['new_amount_recieve']; //ตรวจสอบการรับ ว่าจำนวนที่รับ รับครบตามที่สั่งหรือยัง จำนวนที่รับมา

                    if ($OrderDetail->amount <= 0) {
                        $OrderDetail->type = 'รับ';
                    }

                    $OrderDetail->description = $product['description'];
                    $OrderDetail->amount_recieve = $OrderDetail->amount_recieve + $product['new_amount_recieve'];

                    if ($shipping_price != 0) {
                        $OrderDetail->wholesale_price = $product['cost_price'] + $shipping_price;
                    }

                    $OrderDetail->wholesale_price = $product['cost_price'];
                    $result = $OrderDetail->save();

                }
            }
        }

        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function store(Request $request)
    // {
    //     $datas_validate = $request->validate([ //จรวจสอบค่า
    //         'setting_master_product_id' => 'required',
    //         'vin' => 'sometimes',
    //         'branch' => 'sometimes',
    //         'tags' => 'sometimes',
    //         'description' => 'required',

    //         'retail_price' => 'required',
    //         'wholesale_price' => 'required',
    //         'shipping_price' => 'sometimes',
    //         'new_amount_recieve' => 'sometimes',
    //     ]);

    //     $datas = [ //แบ่ง data เพราะ insert กับ update ลงคนละที่ กัน  โดยinsert จะลง product และ update จะลง orderDetail และ ทั้งคู่มี แอตทิบิวต่างกันจึงตำเป็นต้องแยก
    //         'setting_master_product_id' => $datas_validate['setting_master_product_id'],
    //         'vin' => $datas_validate['vin'],
    //         'tags' => $datas_validate['tags'],
    //         'description' => $datas_validate['description'],
    //         'retail_price' => $datas_validate['retail_price'],
    //         'wholesale_price' => $datas_validate['wholesale_price'],
    //         'new_amount_recieve' => $datas_validate['new_amount_recieve'],
    //     ];

    //     $query_orderDetail = OrderDetail::find($request->id); //ดึงข้อมูลออกมา
    //     $query_orderDetail->shipping_price = $query_orderDetail->shipping_price + $datas_validate['shipping_price']; //เตรียมข้อมูล ค่าจัดส่ง
    //     $query_orderDetail->amount_recieve = $query_orderDetail->amount_recieve + $datas_validate['new_amount_recieve']; //ตรวจสอบการรับ ว่าจำนวนที่รับ รับครบตามที่สั่งหรือยัง จำนวนที่รับมา
    //     $query_orderDetail->save(); //อัพเดทข้อมูลลงฐานข้อมูล

    //     if ($query_orderDetail->amount == $query_orderDetail->amount_recieve) {

    //         $query_orderDetail->type = 'รับ';
    //         $query_orderDetail->save();

    //         // OrderDetail::where('id', $query_orderDetail->id)->update(['type' => 'รับสำเร็จ']); //เปลี่ยนสาถานะ เป็นรับสำเร็จ
    //     }

    //     return $query_orderDetail['amount'] . $query_orderDetail['amount_recieve'];

    //     $datas['quantity'] = $datas_validate['new_amount_recieve']; //migrate product ไม่มี new_amount_recieve แต่มี quantity ก็เลยทำให้ new_amount_recieve = quantity

    //     // $product = Product::create($datas); //insert ข้อมูลลงฐานข้อมูล
    //     // if (!$product) {
    //     //     return response()->error(['ไม่สามารถเพิ่มข้อมูลได้'], '40');
    //     // } else {
    //     //     return response()->success($product, [], '0', 200);
    //     // }

    // }
}
