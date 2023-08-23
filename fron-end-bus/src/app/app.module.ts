import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatRadioModule } from '@angular/material/radio';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { MatSelectModule } from '@angular/material/select';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { MatNativeDateModule } from '@angular/material/core';
import { MatTableModule } from '@angular/material/table';
import { MatPaginatorModule } from '@angular/material/paginator';
import { MatSortModule } from '@angular/material/sort';
import { MatCardModule } from '@angular/material/card';
import { MatListModule } from '@angular/material/list';
import { MatChipsModule } from '@angular/material/chips';

import { HttpClientModule } from '@angular/common/http';
import { NgToastModule } from 'ng-angular-popup';
import { NgConfirmModule } from 'ng-confirm-box';

import { RegistrationListComponent } from './registration-list/registration-list.component';
import { CreateRegistrationComponent } from './create-registration/create-registration.component';
import { UserDetailComponent } from './user-detail/user-detail.component';
import { LoginComponent } from './login/login.component';
import { CreateCarrierComponent } from './carrier/create-carrier/create-carrier.component';
import { ListCarrierComponent } from './carrier/list-carrier/list-carrier.component';
import { ShowCarrierComponent } from './carrier/show-carrier/show-carrier.component';
import { EditCarrierComponent } from './carrier/edit-carrier/edit-carrier.component';
import { CreateBusComponent } from './bus/create-bus/create-bus.component';
import { ListBusComponent } from './bus/list-bus/list-bus.component';
import { EditBusComponent } from './bus/edit-bus/edit-bus.component';
import { ShowBusComponent } from './bus/show-bus/show-bus.component';
import { CreateRouteComponent } from './route/create-route/create-route.component';
import { ShowRouteComponent } from './route/show-route/show-route.component';
import { EditRouteComponent } from './route/edit-route/edit-route.component';
import { ListRouteComponent } from './route/list-route/list-route.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { UpdateCompleteComponent } from './route/update-complete/update-complete.component';

@NgModule({
  declarations: [
    AppComponent,
    RegistrationListComponent,
    CreateRegistrationComponent,
    UserDetailComponent,
    LoginComponent,
    CreateCarrierComponent,
    ListCarrierComponent,
    ShowCarrierComponent,
    EditCarrierComponent,
    CreateBusComponent,
    ListBusComponent,
    EditBusComponent,
    ShowBusComponent,
    CreateRouteComponent,
    ShowRouteComponent,
    EditRouteComponent,
    ListRouteComponent,
    DashboardComponent,
    UpdateCompleteComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,

    MatToolbarModule,
    MatButtonModule,
    MatIconModule,
    MatFormFieldModule,
    MatInputModule,
    MatRadioModule,
    MatSelectModule,
    MatDatepickerModule,
    MatNativeDateModule,
    MatTableModule,
    MatPaginatorModule,
    MatSortModule,
    MatCardModule,
    MatListModule,
    MatChipsModule,

    NgToastModule,
    NgConfirmModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
