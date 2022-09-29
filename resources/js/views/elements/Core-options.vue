<template>
    <div>
        <div class="row row-wpanels justify-content-center gx-md-5">
            <div class="col-md-6 mb-3 mb-sm-4">
                <div class="fw-substrate p-block mb-2">
                    <h4 class="mb-3 fwp-size-h">Substrate</h4>
                    <form action="/" method="post" id="substrate_form">
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate0" name="substrate" value="1" />
                            <label for="substrate0">MDF</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate1" name="substrate" value="2" checked="checked" />
                            <label for="substrate1">NAUF MDF</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate2" name="substrate" value="3" />
                            <label for="substrate2">FSC NAUF MDF</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate3" name="substrate" value="4" />
                            <label for="substrate3">FR MDF</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate4" name="substrate" value="5" />
                            <label for="substrate4">NAUF FR MDF</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate5" name="substrate" value="6" />
                            <label for="substrate5">FSC NAUF FR MDF</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate6" name="substrate" value="7" />
                            <label for="substrate6">PB</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate7" name="substrate" value="8" />
                            <label for="substrate7">NAUF PB</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate8" name="substrate" value="9" />
                            <label for="substrate8">FSC NAUF PB</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate9" name="substrate" value="10" />
                            <label for="substrate9">FR PB</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate10" name="substrate" value="11" />
                            <label for="substrate10">NAUF FR PB</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate11" name="substrate" value="12" />
                            <label for="substrate11">FSC NAUF FR PB</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate12" name="substrate" value="13" />
                            <label for="substrate12">Russian Birch VC</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate13" name="substrate" value="14" />
                            <label for="substrate13">Marine VC</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate14" name="substrate" value="15" />
                            <label for="substrate14">Combi Core (VC with MDF Outerplies)</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate15" name="substrate" value="16" />
                            <label for="substrate15">Flexboard (flexible core - Barrel Wrap)</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="substrate16" name="substrate" value="17" />
                            <label for="substrate16">Flexboard (flexibele core - Column Wrap)</label>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6 mb-3 mb-sm-4">
                <div class="fw-thickness p-block mb-2">
                    <h4 class="mb-3 fwp-size-h">Thickness</h4>
                    <form action="/" method="post" id="thickness_form">
                        <div class="custom-radiobtn">
                            <input type="radio" id="thickness0" name="thickness" value="1" />
                            <label for="thickness0">1/8" 3mm</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="thickness1" name="thickness" value="2" checked="checked" />
                            <label for="thickness1">1/4" 6mm</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="thickness2" name="thickness" value="3" />
                            <label for="thickness2">1/2" 12mm</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="thickness3" name="thickness" value="4" />
                            <label for="thickness3">5/8" 15mm</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="thickness4" name="thickness" value="5" />
                            <label for="thickness4">11/16" 17.5mm</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="thickness5" name="thickness" value="6" />
                            <label for="thickness5">3/4" 18mm</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="thickness6" name="thickness" value="7" />
                            <label for="thickness6">15/16" 23.8mm</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Core-options",
        data() {
            return {
                imgpath: "/media/components",
            };
        },
    };
</script>
