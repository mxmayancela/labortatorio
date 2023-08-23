import { HttpErrorResponse } from '@angular/common/http';
import { Component } from '@angular/core';
import { FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NgToastService } from 'ng-angular-popup';
import { BusService } from 'src/app/service/bus.service';
import { CityService } from 'src/app/service/city.service';
import { RouteService } from 'src/app/service/route.service';

@Component({
  selector: 'app-create-route',
  templateUrl: './create-route.component.html',
  styleUrls: ['./create-route.component.scss']
})
export class CreateRouteComponent {
  registrationForm!: FormGroup;
  ciudades: any[] = [];
  buses:any[]=[];
 // idCarrierControl = new FormControl('');

  public isUpdateActive: boolean = false;
  constructor(
    private fb: FormBuilder,
    private api: RouteService,
    private toastService: NgToastService,
    private activateRoute: ActivatedRoute,
    private route: Router,
    private CityService:CityService,
    private BusService:BusService
){ }
  ngOnInit(): void {
    this.registrationForm = this.fb.group({
      id_city_origin: [''],
      id_city_destination: [''],
      id_bus: [''],
      date: [''],
      start_time: [''],
      date_end: [''],
      end_time: [''],
    });
    this.CityService.getCitys().subscribe((response) => {
      const data = response.data;
      this.ciudades = data;
      //console.log(this.ciudades)// Asegúrate de que los nombres de las propiedades coincidan con las de tu servicio
    });
    this.BusService.getBuses().subscribe((response) => {
      const data = response.data;
      this.buses = data;
      //console.log(this.buses)// Asegúrate de que los nombres de las propiedades coincidan con las de tu servicio
    });
  }

  submit() {  
    this.api.postRoute(this.registrationForm.value)
      .subscribe(response => {
        const responseSuccess= response;
        console.log(responseSuccess.success);
        if(!responseSuccess.success){
          this.toastService.error({ detail: 'ERROR', summary: responseSuccess.message, duration: 3000 });
        }
        else{
          this.toastService.success({ detail: 'SUCCESS', summary: 'Ruta registrada correctamente.', duration: 3000 });
          setTimeout(() => {
            this.route.navigate(['/route/list']);
          }, 500); 
  
          this.registrationForm.reset();
        }
       
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
