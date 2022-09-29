<template>
    <div>
        <div id="app">
            <div>
                <header>
                    <div class="logo">
                        <div id="nav-icon" :class="[(sidemenu)?'open':'']" @click="sidemenu = !sidemenu"><span></span> <span></span> <span></span> <span></span> <span></span> <span></span></div>
                        <a href="#" class="router-link-active"><img :src="logopath" alt="FormWood" /> </a>
                    </div>
                    <div class="fw_container">
                        <ul class="progressbar">
                            <li id="fw-wspecies" :class="[(active_step > 1)?'completed':(active_step == 1)?'active':'']"><span title="Wood Species" class="steps">1</span> Wood Species</li>
                            <li id="fw-slicing" :class="[(active_step > 2)?'completed':(active_step == 2)?'active':'']"><span title="Slicing Technique" class="steps">2</span> Slicing Technique</li>
                            <li id="fw-wquality" :class="[(active_step > 3)?'completed':(active_step == 3)?'active':'']"><span title="Quality" class="steps">3</span> Quality</li>
                            <li id="fw-wmatching" :class="[(active_step > 4)?'completed':(active_step == 4)?'active':'']"><span title="Matching" class="steps">4</span> Matching</li>
                            <li id="fw-pcat" :class="[(active_step > 5)?'completed':(active_step == 5)?'active':'']"><span title="Product Category" class="steps">5</span> Product Category</li>
                            <li id="fw-coption" :class="[(active_step > 6)?'completed':(active_step == 6)?'active':'']"><span title="Core Options" class="steps">6 </span> Core Options</li>
                            <li id="fw-backer" :class="[(active_step > 7)?'completed':(active_step == 7)?'active':'']"><span title="Backer" class="steps">7</span> Backer</li>
                            <li id="fw-download" :class="[(active_step > 8)?'completed':(active_step == 8)?'active':'']"><span title="Download" class="steps">8</span> Download</li>
                        </ul>
                    </div>
                </header>
            </div>

            <footer class="">
                <p>© 2022 FormWood, All Rights Reserved.</p>
                <p>Designed &amp; Developed By <a href="https://biorev.com" target="_blank">Biorev</a></p>
            </footer>

            <div>
                <div class="main-wrapper">
                    <div class="section-center">
                        <div id="mainCntWrap" class="mx-auto">
                            <SpeciesVue v-if="active_step == 1" />
                            <SlicingVue v-else-if="active_step == 2" />
                            <Quality v-else-if="active_step == 3" />
                            <Matching v-else-if="active_step == 4" />
                            <ProductCat v-else-if="active_step == 5" />
                            <CoreOptions v-else-if="active_step == 6" />
                            <Backer v-else-if="active_step == 7" />
                            <Download v-else-if="active_step == 8" />
                        </div>
                    </div>
                    <span>
                        <div class="sidemenu " :class="[(sidemenu)?'sidebar-show':'']" style="z-index: 1000;">
                            <div id="sideMenuTab" class="sidemenu-content">
                                <div class="header-bg">
                                    <div class="header"><h2>Product Builder</h2></div>
                                    <div class="content-scroll">
                                        <h3>Species and attribute</h3>

                                        <p>
                                            Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat.
                                        </p>
                                    </div>
                                    <div class="get-in-touch">
                                        <button>Get In Touch</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="footer" :class="[(active_step >= 3 && active_step <= 7)?'mob-footer':'', (bottommenu)?'':'close-footer']">
                            <div class="row h-100 align-items-center">
                                <div class="footer-btns pbtns">
                                    <button type="button" @click="goNext(8)" v-if="active_step >= 3 && active_step <= 7" class="skp-btn">skip to download</button>
                                </div>

                                <div class="footer-btns pbtns" :class="[(bottommenu)?'':'hide-footer-btns']">
                                    <button type="button" @click="goBack()" class="pbs-btn">previous</button>
                                </div>
                                <div class="footer-btns fns-btn" :class="[(bottommenu)?'':'hide-footer-btns']">
                                    <button type="button" @click="goNext()" v-if="active_step <= 7" class="">next</button>
                                </div>
                            </div>
                            <div class="close-arrow" @click="bottommenu = !bottommenu"> <span><fa-icon icon="fa-solid fa-angle-down" :rotation="(bottommenu)?0:180" /></span></div>
                        </div>
                    </span>
                    

                    <div id="button" data-testid="widgetButton" class="chat-closed mobile-size__small bubbleAnimation-appear-done bubbleAnimation-enter-done">
                        <div class="buttonWave"></div>
                        <button
                            type="button"
                            id="button-body"
                            data-testid="widgetButtonBody"
                            class="chrome"
                            tabindex="0"
                            aria-label="Open chat widget"
                            style="background: linear-gradient(135deg, rgb(0, 182, 191), rgb(155, 230, 141)); box-shadow: rgba(2, 6, 16, 0.2) 0px 2px 16px;"
                        >
                            <i class="fa-solid fa-comment" style="color: rgb(255, 255, 255);"> </i>
                            <i class="material-icons type2 for-closed active">
                                <svg id="ic_create" fill="blue" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path>
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                </svg>
                            </i>
                            <i class="material-icons type1 for-opened" style="color: rgb(255, 255, 255);">
                                <svg id="ic_send" fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                </svg>
                            </i>
                            <i class="material-icons type2 for-opened">
                                <svg id="ic_send" fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                </svg>
                            </i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SlicingVue from "./elements/Slicing.vue";
    import SpeciesVue from "./elements/Species.vue";
    import Quality from "./elements/Quality.vue";
    import Matching from "./elements/Matching.vue";
    import ProductCat from "./elements/Product-cat.vue";
    import CoreOptions from "./elements/Core-options.vue";
    import Backer from "./elements/Backer.vue";
    import Download from "./elements/Download.vue";

    export default {
        name: "home",
        components: { SpeciesVue, SlicingVue, Quality, Matching, ProductCat, CoreOptions, Backer, Download },
        data() {
            return {
                logopath: "/media/FormwoodLogo.png",
                imgpath: "/media/components",
                active_step: 1,
                sidemenu:false,
                bottommenu:false
            };
        },
        methods: {
            goNext(val) {
                if (this.active_step <= 7) {
                    if (val) {
                        this.active_step = val;
                    } else {
                        this.active_step++;
                    }
                }
            },
            goBack() {
                if (this.active_step > 1) {
                    this.active_step--;
                }
            },
        },
    };
</script>
