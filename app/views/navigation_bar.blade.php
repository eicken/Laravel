

<?php
$data = Session::all();
#print_r($data);
$user_role = Session::get('user_gruppe_name');
$user_name = Session::get('user_name');
?>
<span>Hallo {{$user_name}} du bist als {{ $user_role}} angemeldet.</span>

<?php  #if($user_role == 'admin') {?>
<li class="topmenu"><a href="{{ URL::to('users') }}"><?php echo trans('messages.Users'); ?></a>    
	<ul>
          <li class="submenu"><a href="{{ URL::to('users/create') }}"><?php echo trans('messages.Create a User'); ?></a></li>
          <li class="submenu"><a href="{{ URL::to('users') }}"><?php echo trans('messages.View All Users'); ?></a> </li>
          <li class="submenu"><a href="{{ URL::to('roles/create') }}"><?php echo trans('messages.Create a Role'); ?></a></li>
          <li class="submenu"><a href="{{ URL::to('roles') }}"><?php echo trans('messages.View All Roles'); ?></a> </li>
     </ul>
</li>
<li class="topmenu"><a href="{{ URL::to('customers') }}"><?php echo trans('messages.Customers'); ?></a>    
	<ul>
          <li class="submenu"><a href="{{ URL::to('customers/create') }}"><?php echo trans('messages.Create a Customer'); ?></a></li>
          <li class="submenu"><a href="{{ URL::to('customers') }}"><?php echo trans('messages.View All Customers'); ?></a> </li>
     </ul>
</li>
<li class="topmenu"><a href="{{ URL::to('projects') }}"><?php echo trans('messages.Projects'); ?></a>    
	<ul>
          <li class="submenu"><a href="{{ URL::to('projects/create') }}"><?php echo trans('messages.Create a Project'); ?></a></li>
          <li class="submenu"><a href="{{ URL::to('projects') }}"><?php echo trans('messages.View All Projects'); ?></a> </li>
     </ul>
</li>
<li class="topmenu"><a href="{{ URL::to('tickets') }}"><?php echo trans('messages.Tickets'); ?></a>    
	<ul>
          <li class="submenu"><a href="{{ URL::to('tickets/create') }}"><?php echo trans('messages.Create a Ticket'); ?></a></li>
          <li class="submenu"><a href="{{ URL::to('tickets') }}"><?php echo trans('messages.View All Tickets'); ?></a> </li>
     </ul>
</li>
<li class="topmenu"><a href="{{ URL::action('AuthController@getLogout') }}"><?php echo trans('messages.logout'); ?></a></li>


<?php #} ?>

