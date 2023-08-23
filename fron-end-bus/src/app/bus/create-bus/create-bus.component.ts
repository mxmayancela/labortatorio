import { HttpErrorResponse } from '@angular/common/http';
import { Component } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NgToastService } from 'ng-angular-popup';
import { BusService } from 'src/app/service/bus.service';
import { CarrierService } from 'src/app/service/carrier.service';
import { FormControl } from '@angular/forms';

@Component({
  selector: 'app-create-bus',
  templateUrl: './create-bus.component.html',
  styleUrls: ['./create-bus.component.scss']
})
export class CreateBusComponent {
  registrationForm!: FormGroup;
  transportistas: any[] = [];
  idCarrierControl = new FormControl('');

  public isUpdateActive: boolean = false;
  constructor
  (private fb: FormBuilder, 
    private api: BusService, 
    private toastService: NgToastService, 
    private activatedRoute: ActivatedRoute, 
    private router: Router,
    private CarrierService: CarrierService) {
  }
  ngOnInit(): void {
    this.registrationForm = this.fb.group({
      unitnumber: [''],
      licenseplate: [''],
      model: [''],
      year: [''],
      capacity: [''],
      id_carrier: [''],
    });
    this.CarrierService.getCarriers().subscribe((response) => {
      const data = response.data;
      this.transportistas = data; 
      //console.log(this.transportistas)// Asegúrate de que los nombres de las propiedades coincidan con las de tu servicio
    });
  }

  submit() {
    this.api.postBus(this.registrationForm.value)
      .subscribe(response => {
        this.toastService.success({ detail: 'SUCCESS', summary: 'Autobus registrado correctamente.', duration: 3000 });
        setTimeout(() => {
          this.router.navigate(['/bus/list']);
        }, 500); 
  
        this.registrationForm.reset();
      },
      (errorResponse: HttpErrorResponse) => {
        const errorData = getValidationMessages(errorResponse);
        const errorMessage = errorResponse.error.message;
        this.toastService.error({ detail: errorMessage,summary: errorData.join('\n'), duration: 3000 });
      });
  }

  
}
function getValidationMessages(errorResponse: HttpErrorResponse): string[] {
  const validationErrors = errorResponse.error.data.errors_validations_fields;
  const errorMessages: string[] = [];

  for (const field in validationErrors) {
    if (validationErrors.hasOwnProperty(field)) {
      const fieldErrors = validationErrors[field];
      fieldErrors.forEach((errorMessage: string) => {
        errorMessages.push(errorMessage);
      });
    }
  }

  return errorMessages;
}