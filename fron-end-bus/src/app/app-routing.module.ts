import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CreateRegistrationComponent } from './create-registration/create-registration.component';
import { RegistrationListComponent } from './registration-list/registration-list.component';
import { UserDetailComponent } from './user-detail/user-detail.component';
import { LoginComponent } from './login/login.component';
import { CreateCarrierComponent } from './carrier/create-carrier/create-carrier.component';
import { ListCarrierComponent } from './carrier/list-carrier/list-carrier.component';
import { ShowCarrierComponent } from './carrier/show-carrier/show-carrier.component';
import { EditCarrierComponent } from './carrier/edit-carrier/edit-carrier.component';
import { CreateBusComponent } from './bus/create-bus/create-bus.component';
import { CreateRouteComponent } from './route/create-route/create-route.component';
import { ListBusComponent } from './bus/list-bus/list-bus.component';
import { ShowBusComponent } from './bus/show-bus/show-bus.component';
import { EditBusComponent } from './bus/edit-bus/edit-bus.component';
import { ShowRouteComponent } from './route/show-route/show-route.component';
import { EditRouteComponent } from './route/edit-route/edit-route.component';
import { ListRouteComponent } from './route/list-route/list-route.component';
import { AuthGuard } from './auth.guard';
import { DashboardComponent } from './dashboard/dashboard.component';
import { UpdateCompleteComponent } from './route/update-complete/update-complete.component';

const routes: Routes = [
  { path: '', component: LoginComponent },
  { path: 'dashboard', canActivateChild: [AuthGuard],component: DashboardComponent},
  { path: 'carrier', canActivateChild:[AuthGuard],children: [
    { path: 'create', component: CreateCarrierComponent },
    { path: 'list', component: ListCarrierComponent },
    { path: 'detail/:id', component: ShowCarrierComponent },
    { path: 'update/:id', component: EditCarrierComponent },
    // { path: 'delete/:id', component: ListCarrierComponent }
  ]},
  { path: 'bus', canActivateChild: [AuthGuard], children: [
    { path: 'create', component: CreateBusComponent },
    { path: 'list', component: ListBusComponent },
    { path: 'detail/:id', component: ShowBusComponent },
    { path: 'update/:id', component: EditBusComponent },
    // { path: 'delete/:id', component: ListCarrierComponent }
  ]},
  { path: 'route', canActivateChild: [AuthGuard], children: [
    { path: 'create', component: CreateRouteComponent },
    { path: 'list', component: ListRouteComponent },
    { path: 'detail/:id', component: ShowRouteComponent },
    { path: 'update/:id', component: EditRouteComponent },
    { path: 'update-complete', component: UpdateCompleteComponent }
  ]},
  { path: 'update/:id', component: CreateRegistrationComponent },
  { path: 'detail/:id', component: UserDetailComponent },
  { path: 'list', component: RegistrationListComponent },
  { path: 'register', component: CreateRegistrationComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
