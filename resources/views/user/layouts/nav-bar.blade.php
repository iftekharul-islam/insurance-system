<style type="text/css">
  #ul a{
    
    border-radius: 3px;
    padding: 5px;
    border-radius: 5px;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
}
#ul a:hover{
  background: #fff;
  color: black;
  border-radius: 0px !important;
  transition: 0.2s;
}
#menu{
  display: none;
}
@media only screen and (max-width: 600px) {
  #menu{
    display: block !important;
    color: #fff;
  }
}
</style>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #cb3535;">
  <a class="navbar-brand" id="menu" href="{{url('/')}}">MENU</a>
  <button class="navbar-toggler" style="border: 2px solid #fff !important;background-color: #ffffff !important;font-size: 14px !important;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" id="ul" style="margin: -3px;">
      <li class="nav-item active" style="margin-right: 17px;">
        <a class="nav-link " href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item" style="margin-right: 17px;">
        <a class="nav-link " href="{{route('about.us')}}">About Us</a>
      </li>
       <li class="nav-item" style="margin-right: 17px;">
        <a class="nav-link " href="{{route('contact.us')}}">Contact Us</a>
      </li>
      <li class="nav-item" style="margin-right: 17px;">
        <a class="nav-link" href="{{route('allNotice')}}">All Notice</a>
      </li>
      <li class="nav-item" style="margin-right: 17px;">
        <a class="nav-link  " href="{{route('disclaimer.page')}}">Disclaimer</a>
      </li>
      <li class="nav-item" style="margin-right: 17px;">
        <a class="nav-link" href="{{route('privacy.page')}}">Privacy Policy</a>
      </li>
    </ul>
    
  </div>
</nav>