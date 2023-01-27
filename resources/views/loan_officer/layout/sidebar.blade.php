<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<aside class="app-sidebar">
     
      <ul class="app-menu">
        <li><a class="app-menu__item" href="{{route('admin.dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
       <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Admin</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{route('list.admin')}}"><i class="icon fa fa-circle-o"></i> List Admin</a></li>
<!--             <li><a class="treeview-item" href="widgets.html"><i class="icon fa fa-circle-o"></i> Manage Category</a></li>
 -->          </ul>
        </li>
        
     
            <li ><a class="app-menu__item" href="{{route('notice.create')}}" ><i class="fa-solid fa-page"></i><span class="app-menu__label">Add Notice</span></a>
          <li ><a class="app-menu__item" href="{{route('site.settings')}}" ><i class="app-menu__icon fa fa-gear"></i><span class="app-menu__label">Settings</span></a>
          
        </li>
      </ul>
    </aside>