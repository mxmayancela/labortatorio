import { HttpErrorResponse } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NgToastService } from 'ng-angular-popup';
import { CarrierService } from 'src/app/service/carrier.service';

@Component({
  selector: 'app-create-carrier',
  templateUrl: './create-carrier.component.html',
  styleUrls: ['./create-carrier.component.scss']
})
export class CreateCarrierComponent implements OnInit{
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
  }

  submit() {
    this.api.postCarrier(this.registrationForm.value)
      .subscribe(
        res => {
          this.toastService.success({ detail: 'SUCCESS', summary: 'Conductor registrado correctamente', duration: 3000 });
          this.registrationForm.reset();
          setTimeout(() => {
            this.router.navigate(['/carrier/list']);
          }, 500); 
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
