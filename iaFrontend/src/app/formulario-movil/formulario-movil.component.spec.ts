import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FormularioMovilComponent } from './formulario-movil.component';

describe('FormularioMovilComponent', () => {
  let component: FormularioMovilComponent;
  let fixture: ComponentFixture<FormularioMovilComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FormularioMovilComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FormularioMovilComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
