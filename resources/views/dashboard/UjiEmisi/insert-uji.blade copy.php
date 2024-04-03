@extends('layout.main')
@section('nama-bengkel'){{ $bengkel_name }}@endsection
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Uji Emisi</h1>
    </div>

    <div class="col-lg-11">
        <form method="post" action="/dashboard/kendaraan" id="formKendaraan">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3 row">
                        <label for="nopol" class="col-sm-4 col-form-label" >No Polisi<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('nopol') is-invalid @enderror" id="nopol" name="nopol" required autofocus value="{{ old('nopol') }}">
                            @error('nopol')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="merk" class="col-sm-4 col-form-label">Merk<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('merk') is-invalid @enderror" id="merk" name="merk" required value="{{ old('merk') }}">
                            @error('merk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                      </div>
                    <div class="mb-3 row">
                      <label for="tipe" class="col-sm-4 col-form-label">Tipe<span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required value="{{ old('tipe') }}">
                          @error('tipe')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror

                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="tahun" class="col-sm-4 col-form-label">Tahun<span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                          <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" required value="{{ old('tahun') }}">
                          @error('tahun')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror

                      </div>

                    </div>
                    <!-- Add other fields for the left column -->
                </div>
                <div class="col-md-6">
                    <div class="mb-3 row">
                        <label for="cc" class="col-sm-4 col-form-label">CC<span class="text-danger">*</span></label>
                        <div class="col-sm-8">

                            <input type="number" class="form-control @error('cc') is-invalid @enderror" id="cc" name="cc" required value="{{ old('cc') }}">
                            @error('cc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="no_rangka" class="col-sm-4 col-form-label">No Rangka (VIN)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('no_rangka') is-invalid @enderror" id="no_rangka" name="no_rangka" value="{{ old('no_rangka') }}">
                            @error('no_rangka')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    



                    <div class="mb-3 row">
                        <label for="no_mesin" class="col-sm-4 col-form-label" focus>No Mesin</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('no_mesin') is-invalid @enderror" id="no_mesin" name="no_mesin" value="{{ old('no_mesin') }}">
                            @error('no_mesin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                        </div>
                    </div>

                    
                    <div class="mb-3 row">
                        <div class="col-sm-4">
                            <label for="bensin" class="form-label">Bahan Bakar<span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bahan_bakar" id="bensin" value="bensin" checked>
                                <label class="form-check-label" for="bensin">Bensin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bahan_bakar" id="solar" value="solar">
                                <label class="form-check-label" for="solar">Solar</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bahan_bakar" id="gas" value="gas">
                                <label class="form-check-label" for="gas">Gas</label>
                            </div>
                        </div>                        
                        @error('bahan_bakar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>
        </form>

        <hr class="hr" />

        <form method="post" action="/dashboard/ujiemisi" id="formUjiEmisi">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3 row">
                        <label for="odometer" class="col-sm-4 col-form-label">Odometer (KM)<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('odometer') is-invalid @enderror" id="odometer" name="odometer" required value="{{ old('odometer') }}">
                            @error('odometer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="co" class="col-sm-4 col-form-label">CO (%)<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('co') is-invalid @enderror" id="co" name="co" required value="{{ old('co') }}">
                            @error('co')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="hc" class="col-sm-4 col-form-label">HC (ppm)<span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control @error('hc') is-invalid @enderror" id="hc" name="hc" required value="{{ old('hc') }}">
                          @error('hc')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror

                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="opasitas" class="col-sm-4 col-form-label">Opasitas</label>
                      <div class="col-sm-8">
                          <input type="number" class="form-control @error('opasitas') is-invalid @enderror" id="opasitas" name="opasitas" value="{{ old('opasitas') }}">
                          @error('opasitas')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror

                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="co2" class="col-sm-4 col-form-label">CO2</label>
                      <div class="col-sm-8">
                          <input type="number" class="form-control @error('co2') is-invalid @enderror" id="co2" name="co2" value="{{ old('co2') }}">
                          @error('co2')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror

                      </div>
                    </div>
                    <!-- Add other fields for the left column -->
                </div>
                <div class="col-md-6">
                    <div class="mb-3 row">
                        <label for="co_koreksi" class="col-sm-4 col-form-label">Co Koreksi (%)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('co_koreksi') is-invalid @enderror" id="co_koreksi" name="co_koreksi"  value="{{ old('co_koreksi') }}">
                            @error('co_koreksi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="o2" class="col-sm-4 col-form-label" focus>O2 (%)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('o2') is-invalid @enderror" id="o2" name="o2"  value="{{ old('o2') }}">
                            @error('o2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="putaran" class="col-sm-4 col-form-label">Putaran (putaran)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('putaran') is-invalid @enderror" id="putaran" name="putaran" value="{{ old('putaran') }}">
                            @error('putaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="temperatur" class="col-sm-4 col-form-label">Temperatur (C)</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control @error('temperatur') is-invalid @enderror" id="temperatur" name="temperatur"value="{{ old('temperatur') }}">
                          @error('temperatur')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror

                    </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="lambda" class="col-sm-4 col-form-label">Lambda</label>
                      <div class="col-sm-8">
                          <input type="number" class="form-control @error('lambda') is-invalid @enderror" id="lambda" name="lambda" value="{{ old('lambda') }}">
                          @error('lambda')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror

                      </div>
                    </div>
                </div>
            </div>
            {{-- <button type="submit" class="btn btn-primary" id="submitBothForms">Insert Hasil Uji</button> --}}
            
        </form>
        <button type="submit" class="btn btn-primary" id="submitBothForms">Insert Hasil Uji</button>


    </div>

    <script>
        // Get the forms and button by ID
        // const formKendaraan = $('#formKendaraan');
        // const formUjiEmisi = $('#formUjiEmisi');
        // const submitButton = $('#submitBothForms');
        const nopolInput = $('#nopol');
      
        // Add a click event listener to the button
        submitButton.click(function(event) {
          // Prevent default form submission
          event.preventDefault();
      
          // Get form data
          const formDataKendaraan = formKendaraan.serialize();
      
          // Submit form data using AJAX
          $.ajax({
            type: 'POST',
            url: '/dashboard/kendaraan',
            data: formDataKendaraan,
            success: function() {

                // Once formKendaraan has completed, set the value of the nopol input field
                nopolInput.val(formDataKendaraan.nopol);


                // Once formKendaraan has completed, submit formUjiEmisi
                formUjiEmisi.submit();
            },
            error: function(jqXHR, textStatus, errorThrown) {
              // Parse the JSON response
              const response = JSON.parse(jqXHR.responseText);
      
              // Display the validation errors
              const errors = response.errors;
              if (errors) {
                Object.keys(errors).forEach(function(field) {
                  const messages = errors[field];
                  messages.forEach(function(message) {
                    const input = $('[name="' + field + '"]');
                    input.after('<div class="invalid-feedback">' + message + '</div>');
                    input.addClass('is-invalid');
                  });
                });
              }
            }
          });
        });
    </script>


    {{-- <script>
        // Get form and button elements
        const formKendaraan = document.getElementById('formKendaraan');
        const formUjiEmisi = document.getElementById('formUjiEmisi');
        const submitButton = document.getElementById('submitBothForms');

        // Add click event listener to button
        submitButton.addEventListener('click', () => {
        // Programmatically submit both forms
            formUjiEmisi.submit();
            formKendaraan.submit();
        });
    </script> --}}
@endsection



