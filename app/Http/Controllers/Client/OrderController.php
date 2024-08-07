<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderConfirm;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
     /**
     * Hiển thị danh sách đơn hàng
     */
    public function index()
    {   
        
        $donHangs = Auth::user()->donHangs;
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        
        $type_cho_xac_nhan = DonHang::CHO_XAC_NHAN;
        $type_dang_van_chuyen = DonHang::DANG_VAN_CHUYEN;

        return view('clients.donhangs.index',compact('donHangs','trangThaiDonHang','type_cho_xac_nhan','type_dang_van_chuyen'));
    }

    /**
     * Hiển thị giao diện thêm đơn hàng
     */
    public function create()
    {   
        $carts = session()->get('cart',[]);

        if(!empty($carts)){
            $total = 0;
            $subTotal = 0;
            foreach($carts as $items){
                $subTotal +=$items['gia'] * $items['so_luong'];
            }
            $shipping = 30000;
            $total = $subTotal + $shipping;

            return view('clients.donhangs.create',compact('carts','total','subTotal','shipping')); 
        }else{
            return redirect()->route('cart.list');
        }
        
    }

    /**
     * Thực hiện request thêm đơn hàng
     */
    public function store(OrderRequest $request)
    {
        if($request->isMethod('POST')){
            DB::beginTransaction();
           try {
                $params = $request->except('_token');
                $params['ma_don_hang'] = $this->genderateUniqueOrderCode();
                // dd($params);
                $donHang = DonHang::create($params);
                $donHangId = $donHang->id;

                $carts = session()->get('cart',[]);

                foreach($carts as $key => $items){

                    $thanhTien = $items['gia'] * $items['so_luong'];

                    $donHang->chiTietDonHang()->create([
                        'don_hang_id' => $donHangId,
                        'san_pham_id' => $key,
                        'don_gia' => $items['gia'],
                        'so_luong' => $items['so_luong'],
                        'thanh_tien' => $thanhTien,
                    ]);
                }
                DB::commit();
                // Khi thêm thành công sẽ thực hiện các công việc bên dưới này

                // Trừ đi số lượng của sản phẩm , tự sử lý
                // Gửi mail khi đặt hàng thành công
                Mail::to($donHang->email_nguoi_nhan)->queue(new OrderConfirm($donHang));

                session()->put('cart',[]);
                return redirect()->route('donhangs.index')->with('success','Đơn hàng đã được tạo thành công !.');


           } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('cart.list')->with('error','Có lỗi khi tạo đơn hàng. Vui lòng thử lại sau.');
           }
        }
      
    }

    /**
     * Xem chi tiết đơn hàng
     */
    public function show(string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;
        return view('clients.donhangs.show',compact('donHang','trangThaiDonHang','trangThaiThanhToan'));
    }


    /**
     * Thực hiện thay đổi trạng thái đơn hàng
     */
    public function update(Request $request, string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);
        DB::beginTransaction();
        try {
            if($request->has('huy_don_hang')){
                $donHang->update(['trang_thai_don_hang'=>DonHang::HUY_DON_HANG]);
            }elseif($request->has('da_giao_hang')){
                $donHang->update(['trang_thai_don_hang'=>DonHang::DA_GIAO_HANG]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->back();

    }




    function genderateUniqueOrderCode(){
        do {
            $orderCode = 'ORD-'.Auth::id().'-'.now()->timestamp;
        } while (DonHang::where('ma_don_hang',$orderCode)->exists());
        return $orderCode;
    }
}
