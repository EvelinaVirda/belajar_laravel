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
                <h4 data-id="{{$item->dc_id}}" class="subheading">{{$item->dc_subtitle}}</h4>
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
        $('.subheading').click(function(){
            var id = $(this).attr("data-id");
            console.log("id",id);
        });
    });
</script>
@endsection

