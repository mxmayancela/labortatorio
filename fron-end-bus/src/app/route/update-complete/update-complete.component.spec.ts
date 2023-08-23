import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdateCompleteComponent } from './update-complete.component';

describe('UpdateCompleteComponent', () => {
  let component: UpdateCompleteComponent;
  let fixture: ComponentFixture<UpdateCompleteComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ UpdateCompleteComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(UpdateCompleteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
