import { Component,OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Route } from 'src/app/model/route';
import { RouteService } from 'src/app/service/route.service';

@Component({
  selector: 'app-show-route',
  templateUrl: './show-route.component.html',
  styleUrls: ['./show-route.component.scss']
})
export class ShowRouteComponent implements OnInit{
 routeId!: number;
  routeDetails!: Route;
  constructor(private activatedRoute: ActivatedRoute, private api: RouteService,private router:Router) { }

  ngOnInit() {
    this.activatedRoute.params.subscribe(val => {
      this.routeId = val['id'];
      this.fetchUserDetails(this.routeId);
    })
  }

  fetchUserDetails(routeId: number) {
    this.api.getRouteId(routeId)
      .subscribe({
        next: (res) => {
          this.routeDetails = res.data;
          console.log(this.routeDetails);
        },
        error: (err) => {
          console.log(err);
        }
      })
  }
  goBack(url: string) {
    this.router.navigateByUrl(url);
  }

}
