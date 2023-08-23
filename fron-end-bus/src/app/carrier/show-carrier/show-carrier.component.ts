import { Component,OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Carrier } from 'src/app/models/carrier';
import { CarrierService } from 'src/app/service/carrier.service';

@Component({
  selector: 'app-show-carrier',
  templateUrl: './show-carrier.component.html',
  styleUrls: ['./show-carrier.component.scss']
})
export class ShowCarrierComponent implements OnInit{
  carrierId!: number;
  carrierDetails!: Carrier;
  constructor(private activatedRoute: ActivatedRoute, private api: CarrierService) { }

  ngOnInit() {
    this.activatedRoute.params.subscribe(val => {
      this.carrierId = val['id'];
      this.fetchUserDetails(this.carrierId);
    })
  }

  fetchUserDetails(carrierId: number) {
    this.api.getCarrierId(carrierId)
      .subscribe({
        next: (res) => {
          this.carrierDetails = res.data;
        },
        error: (err) => {
          console.log(err);
        }
      })
  }

}
