<template>
    <div>
        <form class="mb-5 sel-1">
            <div class="row">
                <div class="col-sm-12 col-lg-12 mb-2 mb-lg-0">
                    <div class="form-group">
                        <span class="form-control-spe select-slicing">
                            <select class="form-control valid" name="slicing" aria-invalid="false">
                                <option value=".s-1" data-id="1">Book match</option>
                                <option value=".s-2" data-id="2">Slip match</option>
                                <option value=".s-3" data-id="3">Reverse slip match</option>
                                <option value=".s-4" data-id="4">Mix match</option>
                            </select>
                            <label>Select matching</label>
                        </span>
                    </div>
                </div>
            </div>
        </form>

        <div class="row row-wmatching justify-content-center">
            <div class="col-quality col-12 col-md-6 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-wmatching-1" name="wmatching" data-delete="Book match" value="1" />
                <label for="fw-wmatching-1">
                    <div class="radio-img">
                        <div class="wmatching-card-hover">
                            <span>
                                Choose this<br />
                                matching
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/book-match.jpg" alt="B" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Book match</div>
                </label>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Matching",
        data() {
            return {
                imgpath: "/media/components",
            };
        },
    };
</script>
