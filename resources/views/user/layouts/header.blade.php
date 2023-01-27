 <style type="text/css">
     header {
         background-color: #47a812;
         width: 100%;
         height: 47px;
     }

     .tt {
         margin: 7px;
         font-family: arial;

     }



     .tt a {
         color: #fff;
         font-size: 20px;
         text-decoration: none;
     }


     #title {
         margin-right: auto;
     }

     /*@media (max-width: 450px) {*/
     /*      ul{*/
     /*        flex-wrap: wrap;*/
     /*        justify-content: center;*/
     /*        background-color: #F5A281;*/
     /*        padding: 0;    */
     /*      }*/

     /*    #title {*/
     /*      flex-basis: 100%;*/
     /*      text-align: center;*/
     /*      margin-left: 0;*/
     /*    }*/
     /*}*/
 </style>
 {{-- @php
   $data = DB::table('site_settings')->get();
@endphp --}}
 {{-- @foreach ($data as $data)
@endforeach --}}
 <header>
     <ul style="display: flex;
  justify-content: flex-end;
  list-style-type: none;">
         <li class="tt" id="title" style="padding: 4px;"><a type="call" href="#" style="color: #fff;"><i
                     class="fa-solid fa-phone"></i>&nbsp;+919007049952</a></li>
         <div id="fb">
             <li class="tt" style="background: #fff;
    padding: 5px;
    border-radius: 27px;
    width: 33px;">
                 {{-- <a href="{{ $data->fb_link }}" target="_blank" style="    color: black;
    margin-left: 2px;">  --}}

                 <a href="#" target="_blank" style="    color: black;
    margin-left: 2px;">
                     <i class="fa-brands fa-facebook" style="font-size: 18px;
    margin-top: 3px;"></i>
                 </a>
             </li>

         </div>


         <div id="fb">
             <li class="tt" style="background: #fff;
    padding: 5px;
    border-radius: 27px;
    width: 33px;">


                 {{-- <a href="{{ $data->insta_link }}" target="_blank" style="    color: black;
    margin-left: 2px;"> --}}
                 <a href="#" target="_blank" style="    color: black;
    margin-left: 2px;">


                     <i class="fa-brands fa-instagram" style="font-size: 18px;
    margin-top: 3px;"></i>
                 </a>
             </li>

         </div>


         <div id="fb">
             <li class="tt" target="_blank"
                 style="background: #fff;
    padding: 5px;
    border-radius: 27px;
    width: 33px;">
                 {{-- <a href="{{ $data->twitter_link }}" style="    color: black;
    margin-left: 2px;">  --}}
    <a href="#" style="    color: black;
    margin-left: 2px;">
                     <i class="fa-brands fa-twitter" style="font-size: 18px;
    margin-top: 3px;">
                     </i>
                 </a>
             </li>

         </div>

         <div id="fb">
             <li class="tt" target="_blank"
                 style="background: #fff;
    padding: 5px;
    border-radius: 27px;
    width: 33px;">
                 {{-- <a href="{{ $data->linkdin_link }}" style="    color: black;
    margin-left: 2px;">    --}}

    <a href="#" style="    color: black;
    margin-left: 2px;">
                     <i class="fa-brands fa-linkedin" style="font-size: 18px;
    margin-top: 3px;">
                     </i>
                 </a>
             </li>

         </div>
     </ul>
 </header>
