<template>
    <div>
        <form class="mb-5">
            <div class="row">
                <div class="col-sm-12 col-lg-12 mb-2 mb-lg-0">
                    <div class="form-group">
                        <span class="form-control-spe select-spe">
                            <select class="form-control valid" name="species" aria-invalid="false">
                                <option value=".s-1" data-id="1">Maple</option>
                                <option value=".s-2" data-id="2">Plain slice light</option>
                                <option value=".s-3" data-id="3">Rift dark</option>
                                <option value=".s-4" data-id="4">Rift light</option>
                                <option value=".s-5" data-id="5">Plain slice dark</option>
                                <option value=".s-6" data-id="6">Rift red oak</option>
                            </select>
                            <label>Select species and attribute</label>
                        </span>
                    </div>
                </div>
            </div>
        </form>

        <div class="row row-species justify-content-center gx-md-5 gy-md-4">
            <div class="col-species col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-wspecies-1" name="wspecies" data-delete="Maple" value="1" />
                <label for="fw-wspecies-1">
                    <div class="radio-img">
                        <div class="species-card-hover">
                            <span>
                                Choose this<br />
                                wood species
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/maple.jpg" alt="Maple" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Maple</div>
                    <fa-icon icon="fa-solid fa-user-secret" />
                </label>
            </div>

            <div class="col-species col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-wspecies-2" name="wspecies" data-delete="Plain slide light" value="2" />
                <label for="fw-wspecies-2">
                    <div class="radio-img">
                        <div class="species-card-hover">
                            <span>
                                Choose this<br />
                                wood species
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/plan-slc-lgt.jpg" alt="Plain slide light" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Plain slice light</div>
                </label>
            </div>

            <div class="col-species col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-wspecies-3" name="wspecies" data-delete="Rift dark" value="3" />
                <label for="fw-wspecies-3">
                    <div class="radio-img">
                        <div class="species-card-hover">
                            <span>
                                Choose this<br />
                                wood species
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/rift-dark.jpg" alt="Rift dark" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Rift dark</div>
                </label>
            </div>

            <div class="col-species col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-wspecies-4" name="wspecies" data-delete="Rift light" value="4" />
                <label for="fw-wspecies-4">
                    <div class="radio-img">
                        <div class="species-card-hover">
                            <span>
                                Choose this<br />
                                wood species
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/rift-light.jpg" alt="Rift light" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Rift light</div>
                </label>
            </div>

            <div class="col-species col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-wspecies-5" name="wspecies" data-delete="Plain slice dark" value="5" />
                <label for="fw-wspecies-5">
                    <div class="radio-img">
                        <div class="species-card-hover">
                            <span>
                                Choose this<br />
                                wood species
                            </span>
                        </div>
                        <img class="img-fluid w-100" src="/media/components/plan-slc-dark.jpg" alt="Plain slice dark" />
                    </div>
                    <div class="radio-txt match-height" style="height: 78px;">Plain slice dark</div>
                </label>
            </div>

            <div class="col-species col-3 col-md-3 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="fw-wspecies-6" name="wspecies" data-delete="Rift red oak" value="6" />
                <label for="fw-wspecies-6">
                    <div class="radio-img">
                        <div class="species-card-hover">
                            <span>
                                Choose this<br />
                                wood species
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
        name: "Species",
        data() {
            return {
                imgpath: "/media/components",
            };
        },
    };
</script>
