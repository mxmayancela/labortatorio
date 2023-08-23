import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreateCarrierComponent } from './create-carrier.component';

describe('CreateCarrierComponent', () => {
  let component: CreateCarrierComponent;
  let fixture: ComponentFixture<CreateCarrierComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CreateCarrierComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CreateCarrierComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
