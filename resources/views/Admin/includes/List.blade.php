<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('home/Admin/dist/img/avatar5.png')}}"alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{auth()->user()->name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
   <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

      @if(check_permeission_main_menues(1)==true)
           
       <li class="nav-item has-treeview {{ ( (request()->is('admin/adminsettings*')||request()->is('admin/TreasuriesPage*')||request()->is('admin/suppliers_categories*')   ))?'menu-open':''  }}     ">
               <a href="#" class="nav-link {{ ( (request()->is('admin/adminsettings*')||request()->is('admin/TreasuriesPage*')  ||request()->is('admin/suppliers_categories*')  ))?'active':''  }}">
               <i class="fa fa-cogs fa-lg" aria-hidden="true"></i>
            <p>
            {{__('words.setting')}}
                    <i class="right fas fa-angle-left"></i>

                 </p>
                  </a>
              <ul class="nav nav-treeview">
             @if(check_permeission_sub_menues(5)==true)    
              <li class="nav-item">
                    <a href="{{ route('admin.adminsettings') }}" class="nav-link {{ (request()->is('admin/adminsettings*'))?'active':'' }}">
                    <i class="fa fa-cog" aria-hidden="true"></i>

                    <p> {{__('words.setting')}}</p>
                    </a>
                 </li>
                 @endif
               @if(check_permeission_sub_menues(1)==true)

                 <li class="nav-item">
                    <a href="{{ route('admin.TreasuriesPage') }}" class="nav-link {{ (request()->is('admin/TreasuriesPage*') )?'active':'' }}">
                    <i class="fa fa-database" aria-hidden="true"></i>
                    <p>{{__('words.Safe_Date')}} </p>
                    </a>
                 </li>
                 @endif
                 @if(check_permeission_sub_menues(26)==true)
                  <li class="nav-item">
                     <a href="{{ route('admin.Services.index') }}" class="nav-link {{ (request()->is('admin/Services*')  and !request()->is('admin/Services_orders*'))?'active':'' }}">
                     <i class="fa fa-cog" aria-hidden="true"></i>

                     <p>
                        {{__('words.Setting_Services')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
               @if(check_permeission_sub_menues(0)==true)
                  <li class="nav-item">
                     <a href="{{ route('admin.suppliers_categories.index') }}" class="nav-link {{ (request()->is('admin/suppliers_categories*') )?'active':'' }}">
                        <p>
                           فئات الموردين         
                        </p>
                     </a>
                  </li>
                  @endif
              </ul>
       </li>
       @endif 

     @if(check_permeission_main_menues(2)==true)

          <li class="nav-item has-treeview {{ ( (request()->is('admin/accountTypes*')||request()->is('admin/accounts*')  ||request()->is('admin/Customer*') ||request()->is('admin/admin_shift*') ||request()->is('admin/supplier*') ||(request()->is('admin/collect_transaction*') ||request()->is('admin/exchange_transaction*') ||request()->is('admin/delegates*') )) && !request()->is('admin/suppliers_orders*')  )?'menu-open':''  }}     ">
               <a href="#" class="nav-link {{ ( (request()->is('admin/accountTypes*')||request()->is('admin/accounts*')  ||request()->is('admin/Customer*') ||request()->is('admin/admin_shift*') ||request()->is('admin/supplier*') ||(request()->is('admin/collect_transaction*') ||request()->is('admin/exchange_transaction*') ||request()->is('admin/delegates*'))) && !request()->is('admin/suppliers_orders*')  )?'active':''  }}">
               <i class="fa fa-users fa-lg" aria-hidden="true"></i>
                  <p>
                  {{__('words.Accounts')}}    
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
               @if(check_permeission_sub_menues(6)==true)
                  <li class="nav-item">
                     <a href="{{ route('admin.accountTypes.index') }}" class="nav-link {{ (request()->is('admin/accountTypes*'))?'active':'' }}">
                        <p>
                        <i class="fa fa-users" aria-hidden="true"></i>
                        {{__('words.Type_accounts')}}    
                        </p>
                     </a>
                </li>
                @endif 
                @if(check_permeission_sub_menues(7)==true)
                  <li class="nav-item">
                     <a href="{{ route('admin.accounts.index') }}" class="nav-link {{ (request()->is('admin/accounts*') )?'active':'' }}">
                     <i class="fa fa-tree "></i>
                         <p>
                        {{__('words.Tree_Account')}}    
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(3)==true)
                  <li class="nav-item">
                     <a href="{{ route('admin.Customer.index') }}" class="nav-link {{ (request()->is('admin/Customer*') )?'active':'' }}">
                     <i class="fa fa-address-card" aria-hidden="true"></i>      
                     <p>
                        {{__('words.Costomer_Account')}}  
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(8)==true)
                  <li class="nav-item">
                     <a href="{{ route('admin.delegates.index') }}" class="nav-link {{ (request()->is('admin/delegates*') )?'active':'' }}">
                     <i class="fa fa-address-card" aria-hidden="true"></i>   
                        
                     <p>
                        {{__('words.Delegate_Account')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(10)==true)
                  <li class="nav-item">
                     <a href="{{ route('admin.supplier.index') }}" class="nav-link {{ (request()->is('admin/supplier*') and !request()->is('admin/suppliers_categories*') )?'active':'' }}">
                     <i class="fa fa-address-card" aria-hidden="true"></i> 
     
  
                     <p>
                        {{__('words.Suppliers_Account')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(12)==true)
                  <li class="nav-item">
                  <a href="#">
                     <i class="fa fa-mony" aria-hidden="true"></i>

                     <p>
                        {{__('words.Collection')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(11)==true)
                  <li class="nav-item">
                     <a href="#">
                     <i class="fa fa-cc" aria-hidden="true"></i>

                     <p>
                        {{__('words.Exchange')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(28)==true)
                  <li class="nav-item">
                     <a href="{{ route('admin.admin_shift.index') }}" class="nav-link {{ (request()->is('admin/admin_shift*') )?'active':'' }}">
                     <i class="fa fa-archive" aria-hidden="true"></i>
                     <p>
                        {{__('words.Safe_Shift')}}   </p>
                     </a>
                  </li>
                  @endif 
               </ul>
       </li>
       @endif 

       @if(check_permeission_main_menues(3)==true)
       <li class="nav-item has-treeview {{ ((request()->is('admin/sales_matrial_types*')||request()->is('admin/stores*') ||request()->is('admin/uoms*') ||request()->is('admin/inv_itemcard_categories*')||request()->is('admin/itemcard*'))and !request()->is('admin/itemcardBalance*')  and !request()->is('admin/stores_inventory*') )?'menu-open':'' }}     ">
               <a href="#" class="nav-link {{ ((request()->is('admin/sales_matrial_types*')||request()->is('admin/stores*') ||request()->is('admin/uoms*') ||request()->is('admin/inv_itemcard_categories*')||request()->is('admin/itemcard*')  ) and !request()->is('admin/itemcardBalance*') and !request()->is('admin/stores_inventory*')  )?'active':'' }}">
               <i class="fa fa-cog fa-lg" aria-hidden="true"></i>
 
                  <p>
                  {{__('words.Set_stores')}} 
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  @if(check_permeission_sub_menues(13)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-clone" aria-hidden="true"></i>
                        <p>
                        {{__('words.Invoices_Categories')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(14)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-cog" aria-hidden="true"></i>

                        <p>
                        {{__('words.Data_Store')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(15)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                        *
                        <p>
                        {{__('words.Unity_Data')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(16)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                        *
                        <p>
                        {{__('words.Itme_Categories')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(17)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                        *
                        <p>
                           
                        {{__('words.ItemCarde')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
               </ul>
       </li>
       @endif 

       @if(check_permeission_main_menues(4)==true)
        <li class="nav-item has-treeview {{ (request()->is('admin/suppliers_orders*') ||request()->is('admin/suppliers_orders_general_return*') ||request()->is('admin/itemcardBalance*') ||request()->is('admin/inv_stores_transfer*') ||request()->is('admin/inv_stores_transfer_incoming*') )?'menu-open':'' }}     ">
               <a href="#" class="nav-link {{ (request()->is('admin/suppliers_orders*') ||request()->is('admin/suppliers_orders_general_return*') ||request()->is('admin/itemcardBalance*')   ||request()->is('admin/inv_stores_transfer*') ||request()->is('admin/inv_stores_transfer_incoming*') )?'active':'' }}">
               <i class="fa fa-hourglass-end fa-lg" aria-hidden="true"></i>
 
                  <p>
                  {{__('words.Store_Movements')}} 
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  @if(check_permeission_sub_menues(18)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-clipboard" aria-hidden="true"></i>
                  <p>
                        {{__('words.Purchases_Invoices')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(19)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-clipboard" aria-hidden="true"></i>
                  <p>
                        {{__('words.Purchases_Invoices_Reverse')}} 

                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(22)==true)
              <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-expand" aria-hidden="true"></i>                                   <p>
                        {{__('words.Storage_conversion_issued')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(23)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-expand" aria-hidden="true"></i>
                                          <p>
                        {{__('words.Storage_conversion_incoming')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                <!--  @if(check_permeission_sub_menues(5)==true)
                  <li class="nav-item">
                     <a href="{{ route('admin.stores_inventory.index') }}" class="nav-link {{ (request()->is('admin/stores_inventory*')  )?'active':'' }}">
                        <p>
                        {{__('words.Inventory_Stores')}} 
                        </p>
                     </a>
                  </li>
             @endif -->
                  @if(check_permeission_sub_menues(21)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="nav-icon fas fa-chart-pie"></i>

                     <p>
                        {{__('words.Balances_items')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
               </ul>
       </li> 
       @endif 

       @if(check_permeission_main_menues(5)==true)
         <li class="nav-item has-treeview {{ (request()->is('admin/SalesInvoices*') || request()->is('admin/SalesReturnInvoices*')||request()->is('admin/Services*') ||request()->is('admin/Services_orders*'))?'menu-open':'' }}     ">
               <a href="#" class="nav-link {{ (request()->is('admin/SalesInvoices*') || request()->is('admin/SalesReturnInvoices*')||request()->is('admin/Services*') ||request()->is('admin/Services_orders*') )?'active':'' }}">
               <i class="fa fa-shopping-cart" aria-hidden="true"></i>
               <p>
                  {{__('words.Seles')}} 

                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  @if(check_permeission_sub_menues(24)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-clipboard" aria-hidden="true"></i> 
                     <p>
                        {{__('words.Invoices_Sales')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(25)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-clipboard" aria-hidden="true"></i>
                     <p>
                        {{__('words.Invoices_Sales_Return')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(27)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-server" aria-hidden="true"></i>
                                          <p>
                        {{__('words.Invoices_Services')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
               </ul>
        </li>
        @endif 

        @if(check_permeission_main_menues(8)==true)
         <li class="nav-item has-treeview {{ (request()->is('admin/admins_accounts*')|| request()->is('admin/permission_rols*')||request()->is('admin/permission_main_menues*')||request()->is('admin/permission_sub_menues*'))?'menu-open':'' }}     ">
               <a href="#" class="nav-link {{ (request()->is('admin/admins_accounts*') || request()->is('admin/permission_rols*')||request()->is('admin/permission_main_menues*')||request()->is('admin/permission_sub_menues*'))?'active':'' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                  {{__('words.Permissions')}} 
                     <i class="right fas fa-angle-left"></i>

                  </p>
               </a>
               <ul class="nav nav-treeview">
                  @if(check_permeission_sub_menues(5)==true)
               <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-filter" aria-hidden="true"></i>
                     <p>
                        {{__('words.Users_roles')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(30)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                        <p>
                        {{__('words.Permissions_Main_Menu')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(31)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-print" aria-hidden="true"></i> 
                     <p>
                        {{__('words.Permissions_sub_Menu')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(32)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-users" aria-hidden="true"></i>
                     <p>
                        {{__('words.Users')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
               </ul>
       </li>
       @endif 

       @if(check_permeission_main_menues(9)==true)
            <li class="nav-item has-treeview {{ (request()->is('admin/FinancialReport*') || request()->is('admin/customeraccountmirror*')||request()->is('admin/stores_inventory*')  ||request()->is('admin/FinancialReport/delegateaccountmirror') )?'menu-open':'' }}     ">
               <a href="#" class="nav-link {{ (request()->is('admin/FinancialReport*') || request()->is('admin/customeraccountmirror*')||request()->is('admin/stores_inventory*')  ||request()->is('admin/FinancialReport/delegateaccountmirror') )?'active':'' }}">
               <i class="fa fa-print fa-lg" aria-hidden="true"></i>

                  <p>
                  {{__('words.Reports')}} 
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  @if(check_permeission_sub_menues(33)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-print" aria-hidden="true"></i>
                     <p>
                        {{__('words.Reports_Supplier')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(34)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                     <i class="fa fa-print" aria-hidden="true"></i>
                     <p>
                        {{__('words.Reports_Customer')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(35)==true)
                  <li class="nav-item">
                          <a href="#" class="nav-link ">            
                            <i class="fa fa-print" aria-hidden="true"></i>
                     <p>
                        {{__('words.Reports_Delegate')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
                  @if(check_permeission_sub_menues(20)==true)
                  <li class="nav-item">
                     <a href="#" class="nav-link ">            
                                 <i class="fa fa-print" aria-hidden="true"></i>
                     <p>
                        {{__('words.Reports_Inventory_Stores')}} 
                        </p>
                     </a>
                  </li>
                  @endif 
               </ul>
            </li>
       @endif 

        <li class="nav-item has-treeview  ">
               <a href="#" class="nav-link ">
               <i class="fa fa-list fa-lg" aria-hidden="true"></i>

                  <p>
                  {{__('words.Support')}} 
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
               </ul>
            </li>
        <i class="nav-icon fas fa-circle-user"></i>

  </ul>
      </nav>
      <!-- /.sidebar-menu -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
    </div>
    <!-- /.sidebar -->
  </aside>

        
       