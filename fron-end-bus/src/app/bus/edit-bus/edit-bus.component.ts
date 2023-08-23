import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NgToastService } from 'ng-angular-popup';
import { Bus } from 'src/app/model/bus';
import { BusService } from 'src/app/service/bus.service';

@Component({
  selector: 'app-edit-bus',
  templateUrl: './edit-bus.component.html',
  styleUrls: ['./edit-bus.component.scss']
})
export class EditBusComponent implements OnInit {
  registrationForm!: FormGroup;
  private userIdToUpdate!: number;
  public isUpdateActive: boolean = false;
  constructor(private fb: FormBuilder, private api: BusService, private toastService: NgToastService, private activatedRoute: ActivatedRoute, private router: Router) {
  }
  ngOnInit(): void {
    this.registrationForm = this.fb.group({
      unitnumber: [''],
      licenseplate: [''],
      model: [''],
      year: [''],
      capacity: [''],
      id_carrier: [''],
      //carrier: [''],
    });
    this.activatedRoute.params.subscribe(val => {
      this.userIdToUpdate = val['id'];
      if (this.userIdToUpdate) {
        this.isUpdateActive = true;
        this.api.getBusId(this.userIdToUpdate)
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
    this.api.postBus(this.registrationForm.value)
      .subscribe(res => {
        this.toastService.success({ detail: 'SUCCESS', summary: 'Conductor registrado', duration: 3000 });
        this.registrationForm.reset();
      });
  }

  fillFormToUpdate(bus: Bus) {
    const formValue = {
      unitnumber: bus.unitnumber,
      licenseplate: bus.licenseplate,
      model: bus.model,
      year: bus.year,
      capacity: bus.capacity,
      id_carrier: bus.carrier.id,
      //carrier: bus.carrier.name,

    };

    if (bus.unitnumber){
      formValue.unitnumber=bus.unitnumber;
    }
    if (bus.licenseplate){
      formValue.licenseplate=bus.licenseplate;
    }
    if (bus.model){
      formValue.model=bus.model;
    }
    if (bus.year){
      formValue.year=bus.year;
    }
    if (bus.capacity){
      formValue.capacity=bus.capacity;
    }
    if (bus.id_carrier){
      formValue.id_carrier=bus.carrier.id;
    }
    // if (bus.carrier){
    //   formValue.carrier=bus.carrier.name;
    // }
  
  
    this.registrationForm.setValue(formValue);
  }

  update() {
    this.api.updateBus(this.registrationForm.value, this.userIdToUpdate)
      .subscribe(res => {
        this.toastService.success({ detail: 'SUCCESS', summary: 'Conductor actualizado correctamente', duration: 3000 });
        this.router.navigate(['bus/list']);
        this.registrationForm.reset();
      });
  }

  
}
