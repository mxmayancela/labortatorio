import { Component,OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NgToastService } from 'ng-angular-popup';
import { Route } from 'src/app/model/route';
import { RouteService } from 'src/app/service/route.service';

@Component({
  selector: 'app-edit-route',
  templateUrl: './edit-route.component.html',
  styleUrls: ['./edit-route.component.scss']
})
export class EditRouteComponent implements OnInit {
  registrationForm!: FormGroup;
  private userIdToUpdate!: number;
  public isUpdateActive: boolean = false;
  constructor(private fb: FormBuilder, private api: RouteService, private toastService: NgToastService, private activatedRoute: ActivatedRoute, private router: Router) {
  }
  ngOnInit(): void {
    this.registrationForm = this.fb.group({
      id_city_origin: [''],
      city_origin: [''],
      id_city_destination: [''],
      city_destination: [''],
      id_bus: [''],
      bus: [''],
      date: [''],
      start_time: [''],
      date_end: [''],
      end_time: [''],
    });
    this.activatedRoute.params.subscribe(val => {
      this.userIdToUpdate = val['id'];
      if (this.userIdToUpdate) {
        this.isUpdateActive = true;
        this.api.getRouteId(this.userIdToUpdate)
          .subscribe({
            next: (res) => {
              this.fillFormToUpdate(res.data);
            },
            error: (err) => {
              console.log(err);
            }
          })
      }
    })
  }

  submit() {
    this.api.postRoute(this.registrationForm.value)
      .subscribe(res => {
        this.toastService.success({ detail: 'SUCCESS', summary: 'Conductor registrado', duration: 3000 });
        this.registrationForm.reset();
      });
  }

  fillFormToUpdate(route: Route) {
    const formValue = {
      id_city_origin:route.city_origin.id,
      id_city_destination:route.city_destination.id,
      id_bus:route.bus.id,
     city_origin:route.city_origin.cityname,
     city_destination:route.city_destination.cityname,
     bus:route.bus.unitnumber,
      date:route.date,
      start_time:route.start_time,
      date_end:route.date_end,
      end_time:route.end_time,

    };

    if (route.city_origin){
      formValue.city_origin=route.city_origin.cityname;
    }
    if (route.city_destination){
      formValue.city_destination=route.city_destination.cityname;
    }
    if (route.bus){
      formValue.bus=route.bus.unitnumber;
    }
    if (route.date){
      formValue.date=route.date;
    }
    if (route.start_time){
      formValue.start_time=route.start_time;
    }
    if (route.date_end){
      formValue.date_end=route.date_end;
    }
    if (route.end_time){
      formValue.end_time=route.end_time;
    }
    if (route.id_city_origin){
      formValue.id_city_origin=route.id_city_origin;
    }
    if (route.id_city_destination){
      formValue.id_city_destination=route.id_city_destination;
    }
    if (route.id_bus){
      formValue.id_bus=route.id_bus;
    }
    console.log(formValue);
  
    this.registrationForm.setValue(formValue);
  }

  update() {
    this.api.updateRoute(this.registrationForm.value, this.userIdToUpdate)
      .subscribe(res => {
        this.toastService.success({ detail: 'SUCCESS', summary: 'Conductor actualizado correctamente', duration: 3000 });
        this.router.navigate(['route/list']);
        this.registrationForm.reset();
      });
  }




}
