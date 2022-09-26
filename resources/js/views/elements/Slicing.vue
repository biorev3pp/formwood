<template>
    <div>
        <form class="mb-5">
            <div class="row">
                <div class="col-sm-12 col-lg-12 mb-2 mb-lg-0">
                    <div class="form-group">
                        <span class="form-control-spe select-slicing">
                            <select class="form-control valid" name="slicing" aria-invalid="false">
                                <option value=".s-1" data-id="1">Plain sliced</option>
                                <option value=".s-2" data-id="2">Plain sliced light</option>
                                <option value=".s-3" data-id="3">Rift dark</option>
                                <option value=".s-4" data-id="4">Rift light</option>
                                <option value=".s-5" data-id="5">Plain sliced dark</option>
                                <option value=".s-6" data-id="6">Rift red oak</option>
                            </select>
                            <label>Select cutting Technique</label>
                        </span>
                    </div>
                </div>
            </div>
        </form>

        <div class="row row-slicing justify-content-center gx-md-5 gy-md-4">
            <div class="col-slicing col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-slicing-1" name="slicing" data-delete="Maple" value="1" />
                <label for="fw-slicing-1">
                    <div class="radio-img">
                        <div class="slicing-card-hover">
                            <span>
                                Choose this<br />
                                slicing technique
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/maple.jpg" alt="Maple" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Plain sliced</div>
                </label>
            </div>

            <div class="col-slicing col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-slicing-2" name="slicing" data-delete="Plain slide light" value="2" />
                <label for="fw-slicing-2">
                    <div class="radio-img">
                        <div class="slicing-card-hover">
                            <span>
                                Choose this<br />
                                slicing technique
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/plan-slc-lgt.jpg" alt="Plain slide light" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Plain sliced light</div>
                </label>
            </div>

            <div class="col-slicing col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-slicing-3" name="slicing" data-delete="Rift dark" value="3" />
                <label for="fw-slicing-3">
                    <div class="radio-img">
                        <div class="slicing-card-hover">
                            <span>
                                Choose this<br />
                                slicing technique
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/rift-dark.jpg" alt="Rift dark" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Rift dark</div>
                </label>
            </div>

            <div class="col-slicing col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-slicing-4" name="slicing" data-delete="Rift light" value="4" />
                <label for="fw-slicing-4">
                    <div class="radio-img">
                        <div class="slicing-card-hover">
                            <span>
                                Choose this<br />
                                slicing technique
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/rift-light.jpg" alt="Rift light" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Rift light</div>
                </label>
            </div>

            <div class="col-slicing col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-slicing-5" name="slicing" data-delete="Plain slice dark" value="5" />
                <label for="fw-slicing-5">
                    <div class="radio-img">
                        <div class="slicing-card-hover">
                            <span>
                                Choose this<br />
                                slicing technique
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/plan-slc-dark.jpg" alt="Plain slice dark" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Plain sliced dark</div>
                </label>
            </div>

            <div class="col-slicing col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-slicing-6" name="slicing" data-delete="Rift red oak" value="6" />
                <label for="fw-slicing-6">
                    <div class="radio-img">
                        <div class="slicing-card-hover">
                            <span>
                                Choose this<br />
                                slicing technique
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/rift-red-oak.jpg" alt="Rift red oak" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Rift red oak</div>
                </label>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Slicing",
        data() {
            return {
                imgpath: "/media/components",
            };
        },
    };
</script>
