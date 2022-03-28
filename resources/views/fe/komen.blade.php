@extends('fe/base')
@section('content')
    <section class="blog-section blog-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-sm-12 col-xs-12">
                    <div class="left-side">
                        <div class="item-holder">
                            <div class="row">
                            @foreach($data as $dd)
                                <div class="col-md-6">
                                    <div class="image-box">
                                        <figure>
                                            <img src="Assets1/images/FOTO_PRODUK/{{$dd->FOTO}}" style="width: 100%;height: 440px" alt="">
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="images-text">
                                        <h6>{{$dd->NAMA_PRODUK}}</h6>
                                        <h6 style="font-size: 16px"><?php echo "Rp. ".number_format($dd->HARGA)." ,-"; ?></h6>   
                                    </div>  
                                </div>
                            @endforeach      
                                    
                            </div>
                                                     
                        </div>
                        <?php if(Session::get('berhasil')){ ?>
                            <div class="alert" style="color: #155724;background-color: #d4edda;border-color: #c3e6cb;margin-bottom: 0px;padding: 10px; margin-bottom: 10px">
                             <!--    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> -->
                                 Login Berhasil
                            </div>
                        <?php }else if(Session::get('gagal')){ ?>
                            <div class="alert alert-success" style=" color: #721c24; background-color: #FFF3CD; border-color: #FFEEBA;margin-bottom: 0px; padding: 10px; margin-bottom: 10px">
                               <!--  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> -->
                                 Maaf Akun sedang Nonaktif
                            </div>
                             
                        <?php } ?>
                        <div class="comment-area">
                            @foreach($jkom as $komj)
                            <h5>COMMENTS( {{$komj->jumkom}} )</h5>
                            @endforeach
                           
                            @foreach($tkom as $komt)
                            <div class="item">
                                <div class="image-box">

                                
                                    <figure>
                                        <img style="width: 70px;height: 70px" src="Assets1/images/FOTO/{{$komt->FOTO}}" alt="">
                                    </figure>
                                </div>
                                <ul class="reply-btn">
                                    <li><a href="#"><i class="fa fa-reply-all" aria-hidden="true"></i>Reply</a></li>
                                </ul>
                                <h6>{{$komt->NAMA}}</h6>

                           
                                <p>{{$komt->KOMENTAR}}</p>
                                
                            </div>
                            @endforeach
                        </div>
                        <div class="post-comment">
                            <h5>POST A COMMENT</h5>
                            <form action="/postkomen" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row clearfix">
                                    @foreach($data as $id)
                                    <input type="hidden" name="idp" value="{{$id->ID_PRODUK}}">
                                    @endforeach
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="USERNAME" class="form-control" value="" placeholder="Username" required="" autocomplete="off">
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="PASSWORD" class="form-control" value="" placeholder="Password" required="" autocomplete="off">
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <textarea name="KOMENTAR" class="form-control textarea required" placeholder="Komentar"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                                            <button class="btn-one" type="submit" data-loading-text="Please wait...">Post</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>                      
                </div>
                <div class="col-lg-3 col-sm-12 col-xs-12">
                    
                </div>
            </div>                    
        </div>
    </section>

@endsection


    
