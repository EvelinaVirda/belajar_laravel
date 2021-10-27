@extends('template.main')

@section('isi_kontent')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    .how-section1{
        margin-top:-10%;
        padding: 10%;
    }
    .how-section1 h4{
        color: #ffa500;
        font-weight: bold;
        font-size: 30px;
    }
    .how-section1 .subheading{
        color: #3931af;
        font-size: 20px;
    }
    .how-section1 .row
    {
        margin-top: 10%;
    }
    .how-img 
    {
        text-align: center;
    }
    .how-img img{
        width: 40%;
    }
</style>
<div class="container">
    <div class="how-section1">
        {{-- <button id="button_test" class="btn btn-primary" style="margin-top:10px">button</button> --}}
        @foreach ($data_content as $item)    
        <div class="row">

            @php
                $id = $item->dc_id;
                if($id % 2 == 0){
                    $position = true;
                }else{
                    $position = false;
                }
            @endphp
                @if ($position == true)
                    <div class="col-md-6 how-img">
                        <img src="{{$item->dc_image}}" class="rounded-circle img-fluid" alt=""/>
                    </div>            
                @endif
            <div class="col-md-6">
                <h4>{{$item->dc_title}}</h4>
                    <div id="bungkus_subtitle-{{$item->dc_id}}">
                        <h4 id="subtitle-{{$item->dc_id}}" data-id="{{$item->dc_id}}" class="subheading">{{$item->dc_subtitle}}</h4>
                    </div>
                    <div id="bungkus_button_simpan-{{$item->dc_id}}">
                        <div id="button_simpan-{{$item->dc_id}}" class="button_simpan" data-id="{{$item->dc_id}}"></div>
                    </div>
                    <div class="isi_subtitle-{{$item->dc_id}}"></div>
                    <p class="text-muted">{{$item->dc_isi}}</p>
            </div>
                @if ($position == false)
                    <div class="col-md-6 how-img">
                        <img src="{{$item->dc_image}}" class="rounded-circle img-fluid" alt=""/>
                    </div>            
                @endif
        </div>
        @endforeach
    </div>
</div>
<script>
    $(document).ready(function(){
        $("body").on("click", ".subheading", function(){
            var id = $(this).attr("data-id");
            $("#subtitle-"+id).html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: '{{route("get_value_subtitle")}}',
                method: "POST",
                data: {
                    id_content:id,
                },
                success: function(response) {
                    // console.log("ok", response.value_subtitle[0].dc_id);
                    $("#button_simpan-"+id).html(`<button class="btn btn-primary btn-sm simpan">simpan</buton>`);
                    $(".isi_subtitle-"+id).html(`<textarea class="textarea_subtitle" data-id="`+ response.value_subtitle[0].dc_id+`" id="textarea_subtitle`+ response.value_subtitle[0].dc_id+`" name="subtitle" rows="4" cols="50">`+ response.value_subtitle[0].dc_subtitle+`</textarea>`);
                },
                error: function(request, status, error) {
                    alert(request.responseText + " Error :" + status + " Error2 :" + error);
                }
            });
        });
        $("body").on("click", ".button_simpan", function(){
            var id = $(this).attr("data-id");
            console.log(id);
            isi_subtitle = $("textarea#textarea_subtitle"+id).val();
            console.log('isi subtitle',isi_subtitle);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: '{{route("update_value_subtitle")}}',
                method: "POST",
                data: {
                    id_content:id,
                    isi_subtitle:isi_subtitle,
                },
                success: function(response) {
                    console.log("terupdate",response);
                    $("#button_simpan-"+id).remove();
                    $("#bungkus_button_simpan-"+id).append(`<div id="button_simpan-`+id+`" class="button_simpan" data-id="`+id+`"></div>`)
                    $("#textarea_subtitle"+id).remove();
                    $("#bungkus_subtitle-"+id).html(`<h4 id="subtitle-`+id+`" data-id="`+id+`" class="subheading">`+isi_subtitle+`</h4>`);
                },
                error: function(request, status, error) {
                    alert(request.responseText + " Error :" + status + " Error2 :" + error);
                }
            });
        })
    });
</script>
@endsection

