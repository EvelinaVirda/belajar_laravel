@extends('template.main')

@section('isi_kontent')
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
                        <i style="font-size:2em; position: absolute;" data-id="{{$item->dc_id}}" class="bi bi-camera"></i>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                            </div>
                            <img src="gambar/{{ Session::get('image') }}" class="rounded-circle img-fluid" alt="">    
                        @else
                            @php
                            $str = $item->dc_image;
                            $pattern = "/http/i";
                            $img_name = preg_match_all($pattern, $str);
                            if($img_name > 0){
                                echo "<img src='$item->dc_image' class='rounded-circle img-fluid' alt=''/>";
                            }else{
                                echo "<img src='gambar/Session::get('image')' class='rounded-circle img-fluid' alt=''/>";
                            }
                            @endphp
                        @endif
                    </div>            
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
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
                        <i style="font-size:2em; position: absolute; padding-right:3px" data-id="{{$item->dc_id}}" class="bi bi-camera"></i>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                            </div>
                            <img src="gambar/{{ Session::get('image') }}" class="rounded-circle img-fluid" alt="">    
                        @else
                            @php
                            $str = $item->dc_image;
                            $pattern = "/http/i";
                            $img_name = preg_match_all($pattern, $str);
                            if($img_name > 0){
                                echo "<img src='$item->dc_image' class='rounded-circle img-fluid' alt=''/>";
                            }else{
                                echo "<img src='gambar/Session::get('image')' class='rounded-circle img-fluid' alt=''/>";
                            }
                            @endphp
                        @endif
                    </div>            
                @endif
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" action="{{route('update_image')}}" enctype="multipart/form-data" id="myform">
                    @csrf
                    <div class='preview'>
                        <img src="" id="img" width="100" height="100">
                    </div>
                    <div>
                        <input type="file" data-id="{{$item->dc_id}}" class="files" id="file_{{$item->dc_id}}" name="gambar" />
                        <input type="submit" class="button but_upload" value="Upload" id="but_upload">
                    </div>
                </form>
                <div class="modal-footer">
                </div>
            </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    
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
        });
        $("body").on("click", ".bi-camera", function(){
            $("#exampleModal").modal("show");
            var id = $(this).attr("data-id");
            console.log("id gambar",id);
                // $(".but_upload").on("click", function(e){
                //     e.preventDefault();
                //     var fd = new FormData();
                //     var files = $(".files")[0].files;
                //     // var files = $(".file")[0].files;
                //     console.log("id", id);                   
                    
                //     console.log("file", files);
                //     if(files.length > 0 ){
                //     fd.append('gambar',files[0]);
                //     $.ajax({
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         },
                //         url: '{{route("update_image")}}',
                //         type: 'POST',
                //         data: fd,
                //         contentType: false,
                //         processData: false,
                //         success: function(response){
                //             if(response != 0){
                //                 console.log("ok");
                //                 // $("#img").attr("src",response); 
                //                 // $(".preview img").show(); // Display image element
                //             }else{
                //                 alert('file not uploaded');
                //             }
                //         },
                //     });
                //     }else{
                //         alert("Please select a file.");
                //     }
            // });
        });
    });
</script>
@endsection

