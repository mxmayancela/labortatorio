import { Component ,OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NgToastService } from 'ng-angular-popup';
import { Carrier } from 'src/app/models/carrier';
import { CarrierService } from 'src/app/service/carrier.service';

@Component({
  selector: 'app-edit-carrier',
  templateUrl: './edit-carrier.component.html',
  styleUrls: ['./edit-carrier.component.scss']
})
export class EditCarrierComponent implements OnInit{
  registrationForm!: FormGroup;
  private userIdToUpdate!: number;
  public isUpdateActive: boolean = false;
  constructor(private fb: FormBuilder, private api: CarrierService, private toastService: NgToastService, private activatedRoute: ActivatedRoute, private router: Router) {
  }
  ngOnInit(): void {
    this.registrationForm = this.fb.group({
      name: [''],
      lastnamefather: [''],
      lastnamemother: [''],
      cedula: [''],
      birthdate: [''],
      license: [''],
    });
    this.activatedRoute.params.subscribe(val => {
      this.userIdToUpdate = val['id'];
      if (this.userIdToUpdate) {
        this.isUpdateActive = true;
        this.api.getCarrierId(this.userIdToUpdate)
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
    this.api.postCarrier(this.registrationForm.value)
      .subscribe(res => {
        this.toastService.success({ detail: 'SUCCESS', summary: 'Conductor registrado', duration: 3000 });
        this.registrationForm.reset();
      });
  }

  fillFormToUpdate(carrier: Carrier) {
    console.log(carrier);
    const formValue = {
      name: carrier.person.name,
      lastnamefather: carrier.person.lastnamefather,
      lastnamemother: carrier.person.lastnamemother,
      cedula: carrier.person.cedula,
      birthdate: carrier.person.birthdate,
      license: carrier.license
    };
  
    if (carrier.name) {
      formValue.name = carrier.person.name;
    }
    if (carrier.lastnamefather) {
      formValue.lastnamefather = carrier.person.lastnamefather;
    }
    if (carrier.lastnamemother) {
      formValue.lastnamemother = carrier.person.lastnamemother;
    }
    if (carrier.cedula) {
      formValue.cedula = carrier.person.cedula;
    }
    if (carrier.birthdate) {
      formValue.birthdate = carrier.person.birthdate;
    }
    if (carrier.license) {
      formValue.license = carrier.license;
    }
  
    this.registrationForm.setValue(formValue);
  }

  update() {
    this.api.updateCarrier(this.registrationForm.value, this.userIdToUpdate)
      .subscribe(res => {
        this.toastService.success({ detail: 'SUCCESS', summary: 'Conductor actualizado correctamente', duration: 3000 });
        this.router.navigate(['carrier/list']);
        this.registrationForm.reset();
      });
  }


}
