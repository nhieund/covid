@extends('layouts.main')

@section('content')
<div class="container">
    <form id="form_covid">
        <div class="form-row align-items-center input-group-lg">
            <div class="col-auto">
                <label for="txtSearch" class="col-form-label font-weight-bold" >Mã nhân viên hoặc Tên</label>
                </div>
                <div class="col-lg-4">
                <input type="text" id="txtSearch" class="form-control input-group-lg" required>
                </div>
                <div class="col-auto">
                    <button id="btnSearch" type="button" class="btn custom-btn">Search</button>
                </div>
            </div>
        </div>
        <br/>
        <div class="collapse row" id="collapseExample">
            <div class="card card-body">
                    <h6>Xin chào ngày mới tốt lành!</h6>
                    <h3 class="text-center">Nguyễn Văn A</h3>
                    <p class="text-danger text-center">Xin hãy nhập nhiệt độ đã đo được và bấm nút submit.</p>
                    <div class="row g-3 align-items-center input-group-lg">
                        <div class="col-auto">
                            <label for="inputPassword6" class="col-form-label font-weight-bold">Nhiệt độ đã đo</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control col-4" required>
                        </div>
                    </div>
                    <br/>
                    <div class="container">
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-success btn-lg col-3">Submit</button>
                          </div>
                        </div>
                    </div>

            </div>
          </div>

    </form>
</div>
<script src="{{asset('js/covid.js')}}"></script>
@endsection
