@extends('layouts.master')
@section('content')
    <div class="container">
        <form action="{{ route('universidades.store') }}" method="POST" id="formUniversidades"
            onsubmit="return checkForm(this);">
            @csrf
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6 offset-md-3">

                        <div class="form-group" style="padding-top: 5em">
                            <label for="alpha_two_code" class="form-label-universidades">Alpha Two Code</label>
                            <input type="text" class="form-control" name="alpha_two_code" placeholder="Example: US">
                        </div>

                        <div class="form-group">
                            <label for="country" class="form-label-universidades">Country</label>
                            <input type="text" class="form-control" name="country" placeholder="Example: United States">
                        </div>

                        <div class="form-group">
                            <label for="domains" class="form-label-universidades">Domains</label>
                            <input type="text" class="form-control" name="domains" placeholder="Example: harvard.edu">
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label-universidades">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Example: Harvard University">
                        </div>

                        <div class="form-group">
                            <label for="web_pages" class="form-label-universidades">Web Page</label>
                            <input type="text" class="form-control" name="web_pages"
                                placeholder="Example: https://www.harvard.edu/">
                        </div>

                        <p style="padding-top: 0.5em"><span style="color: red">Warning:</span> After creating a university,
                          it will be under review by the team for approval.
                        </p>

                        <div class="text-center">
                          <input type="submit" class="form-button-universidades">
                        </div>
                        {{-- <div class="text-center" style="padding-top: 10px">
                            <input type="submit" name="myButton" value="Register">
                            <input type="button" value="Reset Button" onclick="resetForm(this.form);">
                        </div>--}}
                       
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        function checkForm(form) {
            form.myButton.disabled = true;
            form.myButton.value = "Please wait...";
            return true;
        }

        function resetForm(form) {
            form.myButton.disabled = false;
            form.myButton.value = "Submit";
        }
    </script>
@endsection
