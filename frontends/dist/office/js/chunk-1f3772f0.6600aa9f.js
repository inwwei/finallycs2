(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-1f3772f0"],{"1f8b":function(e,t,s){e.exports=s.p+"img/login.d814adb7.png"},"6bac":function(e,t,s){},"8b48":function(e,t,s){"use strict";s.r(t);var a=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"h-screen flex w-full bg-img vx-row no-gutter items-center justify-center",attrs:{id:"page-login"}},[a("div",{staticClass:"vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4"},[a("vx-card",[a("div",{staticClass:"full-page-bg-color",attrs:{slot:"no-body"},slot:"no-body"},[a("div",{staticClass:"vx-row no-gutter justify-center items-center"},[a("div",{staticClass:"vx-col hidden lg:block lg:w-1/2"},[a("img",{staticClass:"mx-auto",attrs:{src:s("1f8b"),alt:"login"}})]),a("div",{staticClass:"vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg"},[a("div",{staticClass:"p-8 login-tabs-container"},[a("div",{staticClass:"vx-card__title mb-4"},[a("h4",{staticClass:"mb-4"},[e._v("ตรวจสอบสิทธิ์")]),a("p",[e._v("ยินดีต้อนรับ กรุณาเข้าระบบก่อนการใช้งาน")])]),a("div",[a("vs-input",{staticClass:"w-full",attrs:{name:"email","icon-no-border":"",icon:"icon icon-user","icon-pack":"feather","label-placeholder":"Username"},model:{value:e.email,callback:function(t){e.email=t},expression:"email"}}),a("vs-input",{staticClass:"w-full mt-6",attrs:{type:"password",name:"password","icon-no-border":"",icon:"icon icon-lock","icon-pack":"feather","label-placeholder":"Password"},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.login(t)}},model:{value:e.password,callback:function(t){e.password=t},expression:"password"}}),a("div",{staticClass:"flex flex-wrap justify-between my-5"},[a("vs-alert",{attrs:{active:e.error,color:"danger"}},[a("span",[e._v(e._s(e.errorMsg))])])],1),a("div",{staticClass:"flex flex-wrap justify-between my-5"},[a("vs-checkbox",{staticClass:"mb-3",model:{value:e.checkbox_remember_me,callback:function(t){e.checkbox_remember_me=t},expression:"checkbox_remember_me"}},[e._v("จดจำฉันไว้")]),a("vs-button",{staticClass:"float-right",on:{click:e.login}},[e._v("เข้าสู่ระบบ")])],1),a("vs-divider",[e._v("Ver 1.0")])],1)])])])])])],1)])},o=[],i={data:function(){return{email:"",password:"",checkbox_remember_me:!1,error:!1,errorMsg:""}},mounted:function(){},methods:{login:function(){var e=this;this.$http.post("/api/login",{email:this.email,password:this.password}).then((function(t){var s=t.data;e.$store.dispatch("setToken",s.data.token).then((function(t){e.$store.dispatch("updateDisplayName",t.fullname),e.$router.push("/").catch((function(){}))}))})).catch((function(t){e.error=!0,e.password="",e.errorMsg=t.response.data.message[0]}))}}},n=i,l=(s("f4995"),s("2877")),r=Object(l["a"])(n,a,o,!1,null,null,null);t["default"]=r.exports},f4995:function(e,t,s){"use strict";s("6bac")}}]);
//# sourceMappingURL=chunk-1f3772f0.6600aa9f.js.map