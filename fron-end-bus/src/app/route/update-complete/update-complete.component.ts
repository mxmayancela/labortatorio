import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { RouteService } from 'src/app/service/route.service';

@Component({
  selector: 'app-update-complete',
  templateUrl: './update-complete.component.html',
  styleUrls: ['./update-complete.component.scss']
})
export class UpdateCompleteComponent implements OnInit {
  routes: any[] = []; // Lista de rutas
  constructor(private routeService: RouteService, private router:Router) {}

  ngOnInit(): void {
    this.loadRoutes(); // Llama a la función para cargar las rutas al iniciar el componente
  }

  loadRoutes() {
    // Llama a tu servicio para obtener la lista de rutas
    this.routeService.incompleteRoutes().subscribe((data) => {
      this.routes = data.data; 
    });
  }

  updateRouteStatus(route: any) {
    this.routeService.updateCompleteRoute(route, route.id).subscribe(() => {
      route.complete = !route.complete;
      this.loadRoutes(); // Vuelve a cargar la lista de rutas después de la actualización
    });
  }

  goToRouteDetails(routeId: number) {
    
    this.router.navigate(['route/detail', routeId])
  }
}