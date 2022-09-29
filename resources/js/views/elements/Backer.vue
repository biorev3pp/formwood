<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-7 mb-1 mb-sm-4">
                <div class="fw-backer p-block mb-2">
                    <h4 class="mb-3 fwp-size-h">Backer</h4>
                    <form action="/" method="post" id="backer_form">
                        <div class="custom-radiobtn">
                            <input type="radio" id="backer0" name="backer" value="1" />
                            <label for="backer0">Same species and grade as face (A)</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="backer1" name="backer" value="2" checked="checked" />
                            <label for="backer1">Same species lower grade as face (1)</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="backer2" name="backer" value="3" />
                            <label for="backer2">Same species C grade sound veneer as face (2)</label>
                        </div>
                        <div class="custom-radiobtn">
                            <input type="radio" id="backer3" name="backer" value="4" />
                            <label for="backer3">Reject sound backer any wood (3)</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Backer",
        data() {
            return {
                imgpath: "/media/components",
            };
        },
    };
</script>
