
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link {{$isactive}}">
              <i class="nav-icon {{$icon}}"></i>
              <p>
                {{$name}}
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">{{$badge}}</span>
                <!-- badge is number which could indicate for items number -->
              </p>
            </a>
            <ul class="nav nav-treeview"> 
              <!-- add nav link component to folder -->
              {{$slot}} 
              <!-- /add nav link component to folder -->
            </ul>
          </li>