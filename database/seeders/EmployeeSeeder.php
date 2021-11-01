<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(Employee::get()->isEmpty()) {
            DB::table('employees')->insert([
                ['code'=>'NTA001','code_checkin'=>'001','name'=>'ISOME SHINYA'],
                ['code'=>'NTA002','code_checkin'=>'002','name'=>'ĐỒNG THỊ HUYỀN TRANG'],
                ['code'=>'NTA003','code_checkin'=>'003','name'=>'PHAN THANH TÂM'],
                ['code'=>'NTA004','code_checkin'=>'004','name'=>'TRẦN DUY KHÁNH'],
                ['code'=>'NTA005','code_checkin'=>'005','name'=>'LÊ DUY HƯNG'],
                ['code'=>'NTA006','code_checkin'=>'006','name'=>'NGUYỄN HUY MẠNH'],
                ['code'=>'NTA007','code_checkin'=>'007','name'=>'NGUYỄN ĐỨC NHIỀU'],
                ['code'=>'NTA008','code_checkin'=>'008','name'=>'NGUYỄN VĂN NHÂN'],
                ['code'=>'NTA009','code_checkin'=>'009','name'=>'PHAN CHÂU ĐẠI'],
                ['code'=>'NTA011','code_checkin'=>'011','name'=>'VÕ THỊ DIỄM NHUNG'],
                ['code'=>'NTA012','code_checkin'=>'012','name'=>'VÕ HỒNG NGHĨA'],
                ['code'=>'NTA013','code_checkin'=>'013','name'=>'BÙI TRẦN CẨM TÚ'],
                ['code'=>'NTA014','code_checkin'=>'014','name'=>'NGUYỄN HỮU LÂM NHÂN'],
                ['code'=>'NTA015','code_checkin'=>'015','name'=>'TRẦN CÔNG HÒA'],
                ['code'=>'NTA016','code_checkin'=>'016','name'=>'ĐẶNG HỮU LONG'],
                ['code'=>'NTA017','code_checkin'=>'017','name'=>'VÕ LONG'],
                ['code'=>'NTA018','code_checkin'=>'018','name'=>'VÕ DUY TÍNH'],
                ['code'=>'NTA019','code_checkin'=>'019','name'=>'HỒ ĐỨC HIẾU'],
                ['code'=>'NTA020','code_checkin'=>'020','name'=>'NGUYỄN LÊ THANH LĨNH'],
                ['code'=>'NTA021','code_checkin'=>'021','name'=>'NGUYỄN THỊ THANH'],
                ['code'=>'NTA022','code_checkin'=>'022','name'=>'NGÔ HÙNG VĨ'],
                ['code'=>'NTA023','code_checkin'=>'023','name'=>'TRẦN HỒNG QUÂN'],
                ['code'=>'NTA024','code_checkin'=>'024','name'=>'LÊ NGHĨA'],
                ['code'=>'NTA026','code_checkin'=>'026','name'=>'NGUYỄN THÀNH HẬU'],
                ['code'=>'NTA027','code_checkin'=>'027','name'=>'ĐẶNG HỮU THỊNH'],
                ['code'=>'NTA028','code_checkin'=>'028','name'=>'TRẦN ĐĂNG KHIÊM'],
                ['code'=>'NTA029','code_checkin'=>'029','name'=>'NGUYỄN HỮU ĐẠI DƯƠNG'],
                ['code'=>'NTA030','code_checkin'=>'030','name'=>'DOÃN VĂN VÂN'],
                ['code'=>'NTA031','code_checkin'=>'031','name'=>'NGUYỄN MINH HOÀNG'],
                ['code'=>'NTA032','code_checkin'=>'032','name'=>'VÕ TÚ QUỲNH'],
                ['code'=>'NTA034','code_checkin'=>'034','name'=>'HÀ HUY ĐỨC'],
                ['code'=>'NTA035','code_checkin'=>'035','name'=>'TRẦN VĂN TIẾN'],
                ['code'=>'NTA036','code_checkin'=>'036','name'=>'LÊ TIẾN ĐẠT'],
                ['code'=>'NTA037','code_checkin'=>'037','name'=>'BÙI VĂN HÙNG'],
                ['code'=>'NTA038','code_checkin'=>'038','name'=>'BÙI THỊ KIM CHI'],
                ['code'=>'NTA039','code_checkin'=>'039','name'=>'NGUYỄN HỮU THANH'],
                ['code'=>'NTA040','code_checkin'=>'040','name'=>'NGUYỄN ĐÀO GIA BẢO'],
                ['code'=>'NTA041','code_checkin'=>'041','name'=>'ĐOÀN LÊ QUỐC PHONG'],
                ['code'=>'NTA042','code_checkin'=>'042','name'=>'NGUYỄN THÀNH GIA HUY'],
                ['code'=>'NTA043','code_checkin'=>'043','name'=>'NGUYỄN ĐỨC BÌNH'],
                ['code'=>'NTA044','code_checkin'=>'044','name'=>'PHẠM ĐỨC TÀI'],
                ['code'=>'NTA045','code_checkin'=>'045','name'=>'HOÀNG NAM NGUYÊN'],
                ['code'=>'NTA046','code_checkin'=>'046','name'=>'ĐINH SƠN ĐỨC '],
                ['code'=>'NTA047','code_checkin'=>'047','name'=>'NGUYỄN ĐỨC THỊNH'],
                ['code'=>'NTA048','code_checkin'=>'048','name'=>'HỒ HỮU THẮNG'],
                ['code'=>'NTA049','code_checkin'=>'049','name'=>'NGUYỄN THỊ LINH'],
                ['code'=>'NTA050','code_checkin'=>'050','name'=>'NGUYỄN VĂN HÒA'],
                ['code'=>'NTA051','code_checkin'=>'051','name'=>'VÕ THỊ TỐ TRÂM'],
                ['code'=>'NTA052','code_checkin'=>'052','name'=>'GIÁP HOÀNG KHANG HY'],
                ['code'=>'NTA053','code_checkin'=>'053','name'=>'TRẦN THỊ HUYỀN TRANG'],
                ['code'=>'NTA054','code_checkin'=>'054','name'=>'LÊ NHẬT LINH '],
                ['code'=>'NTA055','code_checkin'=>'055','name'=>'NGUYỄN QUỐC TOÀN '],
                ['code'=>'NTA056','code_checkin'=>'056','name'=>'NGUYỄN MINH NHỰT'],
                ['code'=>'NTA057','code_checkin'=>'057','name'=>'HỒ VIẾT PHÚ'],
                ['code'=>'NTA059','code_checkin'=>'059','name'=>'NGUYỄN VĂN PHƯỚC'],
                ['code'=>'NTA060','code_checkin'=>'060','name'=>'VÕ THỊ THANH HẰNG'],
                ['code'=>'NTA061','code_checkin'=>'061','name'=>'HỒ NGỌC THẠCH'],
                ['code'=>'NTA062','code_checkin'=>'062','name'=>'TRẦN HỒNG PHÚC'],
                ['code'=>'NTA063','code_checkin'=>'063','name'=>'LƯƠNG THẾ AN'],
                ['code'=>'KHACH0xx','code_checkin'=>'0xx','name'=>'KHÁCH']
            ]);
        }
    }
}
