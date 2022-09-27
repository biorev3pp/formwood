<template>
    <div>
        <form class="mb-5 sel-1">
            <div class="row">
                <div class="col-sm-12 col-lg-12 mb-2 mb-lg-0">
                    <div class="form-group">
                        <span class="form-control-spe select-slicing">
                            <select class="form-control valid" name="slicing" aria-invalid="false">
                                <option value=".s-1" data-id="1">B</option>
                                <option value=".s-2" data-id="2">A</option>
                                <option value=".s-3" data-id="3">AA</option>
                                <option value=".s-4" data-id="4">BA</option>
                            </select>
                            <label>Select wood quality</label>
                        </span>
                    </div>
                </div>
            </div>
        </form>

        <div class="row row-wquality justify-content-center gx-5">
            <div class="col-quality col-12 col-md-4 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-wquality-1" name="wquality" data-delete="B" value="1" />
                <label for="fw-wquality-1">
                    <div class="radio-img">
                        <div class="wquality-card-hover">
                            <span>
                                Choose this<br />
                                wood quality
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/quality-b.jpg" alt="B" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">B</div>
                </label>
            </div>

            <div class="col-wquality col-12 col-md-4 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-wquality-2" name="wquality" data-delete="A" value="2" />
                <label for="fw-wquality-2">
                    <div class="radio-img">
                        <div class="wquality-card-hover">
                            <span>
                                Choose this<br />
                                wood quality
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/quality-a.jpg" alt="A" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">A</div>
                </label>
            </div>

            <div class="col-wquality col-12 col-md-4 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-wquality-3" name="wquality" data-delete="AA" value="3" />
                <label for="fw-wquality-3">
                    <div class="radio-img">
                        <div class="wquality-card-hover">
                            <span>
                                Choose this<br />
                                wood quality
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/quality-aa.jpg" alt="AA" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">AA</div>
                </label>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Quality",
        data() {
            return {
                imgpath: "/media/components",
            };
        },
    };
</script>
