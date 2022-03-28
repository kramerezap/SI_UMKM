@extends('fe/base')
@section('content')
    <!--Gallery Section-->
    <section class="gallery-section">
        <div class="container">
            <div class="section-title text-center">
                <h3>Susu Jelly<span> Kediri</span></h3>
            </div>
            <div class="sortable-masonry">
                <div class="filters">
                    <ul class="filter-tabs filter-btns clearfix text-center">
                     
                    </ul>
                </div>
                <div class="row items-container clearfix">

                @foreach($tmenu as $data)
                    <div class="col-md-3 col-sm-6 col-xs-12 masonry-item all p2 p4 p1 p3">
                        <div class="image-box">
                            <figure>
                                <img src="Assets1/images/FOTO_PRODUK/{{$data->FOTO}}" alt="">
                            </figure>
                            <div class="images-overly">
                                <a href="Assets1/images/FOTO_PRODUK/{{$data->FOTO}}" class="lightbox-image overlay-box"><i class="fa fa-image" aria-hidden="true"></i></a>
                               
                            </div>
                        </div>
                        <div class="title-text">
                            <div class="row">
                                <div class="col-md-9">
                                    <h6 style="text-align: left;margin-top: 3px">{{$data->NAMA_PRODUK}} </h6>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-primary" href="/komen={{$data->ID_PRODUK}}"><i class="fa fa-comment"> </i></a>
                                </div>
                            </div>
                        </div>
                    </div>                
                @endforeach  
                </div>
            </div>
        </div>
    </section>
    <!--End gallery Section-->

@endsection


    
