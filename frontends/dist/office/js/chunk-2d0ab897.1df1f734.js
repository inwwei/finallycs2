(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0ab897"],{1662:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("vs-tabs",{attrs:{color:"rgb(32, 201, 192)"}},[r("vs-tab",{attrs:{label:"ตั้งค่าทั่วไป"}},[r("vs-tabs",{attrs:{position:"left",color:"danger"}},[r("vs-tab",{attrs:{label:"สมาชิก"}},[r("member-basic")],1),r("vs-tab",{attrs:{label:"พนักงาน"}},[r("employee-basic")],1),r("vs-tab",{attrs:{label:"สินค้า"}},[r("product-basic")],1)],1)],1),r("vs-tab",{attrs:{label:"ตั้งค่าพื้นฐาน"}},[r("vs-tabs",{attrs:{position:"left",color:"danger"}},[r("vs-tab",{attrs:{label:"สมาชิก"}},[r("member-general")],1),r("vs-tab",{attrs:{label:"พนักงาน"}},[r("employee-general")],1),r("vs-tab",{attrs:{label:"สินค้า"}},[r("product-general")],1)],1)],1)],1)],1)},a=[],s=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("vx-card",[r("div",{staticClass:"vx-row"},[r("div",{staticClass:"`vx-col w-6`"},[r("custom-tree",{ref:"tree",attrs:{url:"/api/setting/master/user"},on:{onClick:t.onClick,onDelete:t.onDelete}})],1),r("div",{staticClass:"`vx-col w-6`"},[r("setting-form",{ref:"form",on:{clickSubmit:t.clickSubmit}}),r("pre",[t._v(t._s(t.clickData))])],1)])])},i=[],c=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("h1",[t._v("Test")]),r("div",{staticClass:"vx-row"},[r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"Thai","data-vv-as":"Title",col:6},model:{value:t.form.name_th,callback:function(e){t.$set(t.form,"name_th",e)},expression:"form.name_th"}}),r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"Eng","data-vv-as":"Title",col:6},model:{value:t.form.name_en,callback:function(e){t.$set(t.form,"name_en",e)},expression:"form.name_en"}})],1),r("vs-row",[r("vs-col",{attrs:{"vs-type":"flex","vs-justify":"flex-end","vs-align":"center"}},[r("vs-button",{staticClass:"mr-3",on:{click:function(e){return t.clickSubmit()}}},[t._v("บันทึก")]),r("router-link",{attrs:{to:"/product/checkWarehouse"}},[r("vs-button",{attrs:{color:"danger",type:"filled"}},[t._v("ยกเลิก")])],1)],1)],1)],1)},o=[],l={data:function(){return{form:{}}},methods:{clickSubmit:function(){this.$emit("clickSubmit",this.form)}}},u=l,v=r("2877"),m=Object(v["a"])(u,c,o,!1,null,null,null),f=m.exports,p={components:{"setting-form":f},data:function(){return{clickData:null}},mounted:function(){},methods:{onClick:function(t){this.clickData=t,this.$refs.form.form=t},onDelete:function(t,e,r){console.log(t),this.$refs.tree.removeNode(t,e,r)},clickSubmit:function(t){console.log(t),this.$refs.tree.refresh()}}},d=p,h=Object(v["a"])(d,s,i,!1,null,null,null),x=h.exports,b=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("panel",{attrs:{title:"ประเภทของลูกค้า"},scopedSlots:t._u([{key:"header-right",fn:function(){return[r("vs-button",{attrs:{color:"primary",type:"filled"},on:{click:function(e){t.popupActive2=!0}}},[t._v("เพิ่มประเภทของลูกค้า")])]},proxy:!0}])},[r("vs-popup",{attrs:{classContent:"popup-example","text-color":"rgba(0,0,0,0.5)",title:"เพิ่มประเภทของลูกค้า",active:t.popupActive2},on:{"update:active":function(e){t.popupActive2=e}}},[r("form-input",{attrs:{label:"ชื่อประเภทลูกค้า",col:12}}),r("vs-row",[r("vs-col",{attrs:{"vs-type":"flex","vs-justify":"flex-end","vs-align":"center"}},[r("vs-button",{staticClass:"mr-3"},[t._v("บันทึก")]),r("router-link",[r("vs-button",{attrs:{color:"danger",type:"filled"}},[t._v("ยกเลิก")])],1)],1)],1)],1),r("vs-table",{attrs:{search:"",data:t.status},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.data;return t._l(n,(function(e,a){return r("vs-tr",{key:a},[r("vs-td",[t._v("\n          "+t._s(n[a].id)+"\n        ")]),r("vs-td",[t._v("\n          "+t._s(n[a].name)+"\n        ")]),r("vs-td",[t._v("\n          "+t._s(n[a].des)+"\n        ")]),r("vs-td",[r("div",{staticClass:"flex mb-3",attrs:{align:"center"}},[r("div",{staticClass:"w-1/6 bg-grid-color-secondary h-12"},[r("vs-button",{attrs:{color:"primary",type:"flat","icon-pack":"feather",icon:"icon-search"}})],1),r("div",{staticClass:"w-1/6 bg-grid-color h-12"},[r("vs-button",{attrs:{color:"warning",type:"flat","icon-pack":"feather",icon:"icon-edit"}})],1),r("div",{staticClass:"w-1/6 bg-grid-color h-12"},[r("vs-button",{attrs:{color:"danger",type:"flat","icon-pack":"feather",icon:"icon-trash"}})],1),r("div",{staticClass:"w-1/6 bg-grid-color-secondary h-12"})])])],1)}))}}])},[r("template",{slot:"thead"},[r("vs-th",[t._v("ลำดับ")]),r("vs-th",[t._v("ชื่อประเภท")]),r("vs-th",[t._v("รายละเอียด")]),r("vs-th")],1)],2)],1)},g=[],k={name:"member-basic",data:function(){return{status:[{id:1,name:"silver",des:"ให้ความช่วยเหลือและการสนับสนุนด้านต่างๆ"},{id:2,name:"gold",des:"ให้ความช่วยเหลือและการสนับสนุนด้านต่างๆ"},{id:3,name:"platinum",des:"ให้ความช่วยเหลือและการสนับสนุนด้านต่างๆ"}],value1:"",value2:"",popupActive2:!1}}},_=k,w=Object(v["a"])(_,b,g,!1,null,null,null),y=w.exports,$=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("vx-card",[r("div",{staticClass:"vx-row"},[r("div",{staticClass:"vx-col w-5/12"},[r("custom-tree",{ref:"tree",attrs:{url:"/api/setting/master/user"},on:{onClick:t.onClick,onDelete:t.onDelete}})],1),r("div",{staticClass:"vx-col w-7/12"},[r("panel",{directives:[{name:"show",rawName:"v-show",value:t.open,expression:"open"}],attrs:{title:"ตั้งค่า"}},[r("setting-form",{ref:"form",on:{clickSubmit:t.clickSubmit}})],1)],1)])])},C=[],T=(r("96cf"),r("3b8d")),S=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"vx-row"},[r("div",{staticClass:"vx-col w-full"},[r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"Thai","data-vv-as":"Title",col:12},model:{value:t.form.name_th,callback:function(e){t.$set(t.form,"name_th",e)},expression:"form.name_th"}})],1)]),r("div",{staticClass:"vx-row"},[r("div",{staticClass:"vx-col w-full"},[r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"Eng","data-vv-as":"Title",col:12},model:{value:t.form.name_en,callback:function(e){t.$set(t.form,"name_en",e)},expression:"form.name_en"}})],1)]),null!==this.form.ref_id?r("div",{staticClass:"vx-row mb-6 my-5"},[r("div",{staticClass:"vx-col sm:w-2/3 w-full"},[r("vs-radio",{attrs:{"vs-name":"radios1","vs-value":"ล็อกอิน"},model:{value:t.form.checkLogin,callback:function(e){t.$set(t.form,"checkLogin",e)},expression:"form.checkLogin"}},[t._v("ล็อกอิน")]),t._v(" \n  "),r("vs-radio",{attrs:{"vs-name":"radios2","vs-value":"ไม่ล็อกอิน"},model:{value:t.form.checkLogin,callback:function(e){t.$set(t.form,"checkLogin",e)},expression:"form.checkLogin"}},[t._v("ไม่ล็อกอิน")])],1)]):t._e(),r("vs-row",[r("vs-col",{attrs:{"vs-type":"flex","vs-justify":"flex-end","vs-align":"center"}},[r("vs-button",{staticClass:"mr-3",on:{click:function(e){return t.openConfirm()}}},[t._v("บันทึก")]),r("router-link",{attrs:{to:"/product/checkWarehouse"}},[r("vs-button",{attrs:{color:"danger",type:"filled"}},[t._v("ยกเลิก")])],1)],1)],1)],1)},j=[],R={data:function(){return{form:{}}},methods:{openConfirm:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){var e,r;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(this.form.id){t.next=19;break}return t.prev=1,t.next=4,this.$validator.validateAll();case 4:if(e=t.sent,!e){t.next=10;break}return t.next=8,this.$vs.dialog({type:"confirm",color:"success",title:"คุณต้องการเพิ่มข้อมูลหรือไม่",text:"เพิ่มข้อมูลชื่อไทย ".concat(this.form.name_th," ชื่ออังกฤษ ").concat(this.form.name_en),acceptText:"ยืนยัน",cancelText:"ยกเลิก",accept:this.clickSubmitInsert});case 8:t.next=12;break;case 10:return t.next=12,this.$vs.dialog({color:"danger",title:"สถานะการเพิ่มข้อมูล",text:"เพิ่มข้อมูลพนักงานไม่สำเร็จ",acceptText:"ปิด"});case 12:t.next=17;break;case 14:t.prev=14,t.t0=t["catch"](1),console.log("err",t.t0);case 17:t.next=35;break;case 19:return t.prev=19,t.next=22,this.$validator.validateAll();case 22:if(r=t.sent,!r){t.next=28;break}return t.next=26,this.$vs.dialog({type:"confirm",color:"success",title:"คุณต้องการแก้ไขข้อมูลหรือไม่",text:"แก้ไขข้อมูลชื่อไทย ".concat(this.form.name_th," ชื่ออังกฤษ ").concat(this.form.name_en),acceptText:"ยืนยัน",cancelText:"ยกเลิก",accept:this.clickSubmitUpdate});case 26:t.next=30;break;case 28:return t.next=30,this.$vs.dialog({color:"danger",title:"สถานะการเพิ่มข้อมูล",text:"เพิ่มข้อมูลพนักงานไม่สำเร็จ",acceptText:"ปิด"});case 30:t.next=35;break;case 32:t.prev=32,t.t1=t["catch"](19),console.log("err",t.t1);case 35:case"end":return t.stop()}}),t,this,[[1,14],[19,32]])})));function e(){return t.apply(this,arguments)}return e}(),clickSubmitInsert:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,this.$http.post("/api/setting/master/user/",this.form);case 3:return t.next=5,this.$vs.notify({color:"success",title:"ยืนยันการเพิ่มข้อมูล",text:"เพิ่มข้อมูลสำเร็จ"});case 5:return t.next=7,this.$emit("clickSubmit",this.form);case 7:t.next=12;break;case 9:throw t.prev=9,t.t0=t["catch"](0),t.t0;case 12:case"end":return t.stop()}}),t,this,[[0,9]])})));function e(){return t.apply(this,arguments)}return e}(),clickSubmitUpdate:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,this.$http.put("/api/setting/master/user/".concat(this.form.id),this.form);case 3:return t.next=5,this.$vs.notify({color:"success",title:"ยืนยันการแก้ไขข้อมูล",text:"แก้ไขข้อมูลสำเร็จ"});case 5:return t.next=7,this.$emit("clickSubmit",this.form);case 7:t.next=12;break;case 9:throw t.prev=9,t.t0=t["catch"](0),t.t0;case 12:case"end":return t.stop()}}),t,this,[[0,9]])})));function e(){return t.apply(this,arguments)}return e}()}},A=R,O=Object(v["a"])(A,S,j,!1,null,null,null),D=O.exports,q={components:{"setting-form":D},data:function(){return{clickData:null,open:!1}},mounted:function(){},methods:{onClick:function(t){this.clickData=t,this.$refs.form.form=t,this.open=!0},onDelete:function(t,e,r){this.node=t,this.parent=e,this.index=r,this.$vs.dialog({type:"confirm",color:"danger",title:"คุณต้องการลบข้อมูลใช่หรือไม่",text:"ลบข้อมูลพนักงานชื่อ ".concat(this.node.name_th),accept:this.acceptDelete,acceptText:"ยืนยัน",cancelText:"ยกเลิก"})},acceptDelete:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,this.$http.delete("/api/setting/master/user/".concat(this.node.id));case 3:return t.next=5,this.$refs.tree.removeNode(this.node,this.parent,this.index);case 5:return t.next=7,this.$vs.notify({color:"danger",title:"ยืนยันการลบข้อมูล",text:"ลบข้อมูลสำเร็จ"});case 7:t.next=12;break;case 9:throw t.prev=9,t.t0=t["catch"](0),t.t0;case 12:case"end":return t.stop()}}),t,this,[[0,9]])})));function e(){return t.apply(this,arguments)}return e}(),clickSubmit:function(t){console.log(t),this.$refs.tree.refresh()}}},N=q,E=Object(v["a"])(N,$,C,!1,null,null,null),L=E.exports,I=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("panel",{attrs:{title:"ประเภทสินค้า"},scopedSlots:t._u([{key:"header-right",fn:function(){return[r("vs-button",{attrs:{color:"primary",type:"filled"},on:{click:function(e){t.popupActive2=!0}}},[t._v("เพิ่มประเภทสินค้า")])]},proxy:!0}])},[r("vs-popup",{attrs:{classContent:"popup-example","text-color":"rgba(0,0,0,0.5)",title:"เพิ่มประเภทของสินค้า",active:t.popupActive2},on:{"update:active":function(e){t.popupActive2=e}}},[r("form-input",{attrs:{label:"ชื่อประเภทสินค้า",col:11}}),r("vs-row",[r("vs-col",{attrs:{"vs-type":"flex","vs-justify":"flex-end","vs-align":"center"}},[r("vs-button",{staticClass:"mr-3"},[t._v("บันทึก")]),r("router-link",[r("vs-button",{attrs:{color:"danger",type:"filled"}},[t._v("ยกเลิก")])],1)],1)],1)],1),r("vs-table",{attrs:{search:"",data:t.users},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.data;return t._l(n,(function(e,a){return r("vs-tr",{key:a},[r("vs-td",[t._v("\n          "+t._s(n[a].id)+"\n        ")]),r("vs-td",[t._v("\n          "+t._s(n[a].name)+"\n        ")]),r("vs-td",[t._v("\n          "+t._s(n[a].des)+"\n        ")]),r("vs-td",[r("div",{staticClass:"flex mb-3",attrs:{align:"center"}},[r("div",{staticClass:"w-1/6 bg-grid-color-secondary h-12"},[r("vs-button",{attrs:{color:"primary",type:"flat","icon-pack":"feather",icon:"icon-search"}})],1),r("div",{staticClass:"w-1/6 bg-grid-color h-12"},[r("vs-button",{attrs:{color:"warning",type:"flat","icon-pack":"feather",icon:"icon-edit"}})],1),r("div",{staticClass:"w-1/6 bg-grid-color h-12"},[r("vs-button",{attrs:{color:"danger",type:"flat","icon-pack":"feather",icon:"icon-trash"}})],1),r("div",{staticClass:"w-1/6 bg-grid-color-secondary h-12"})])])],1)}))}}])},[r("template",{slot:"thead"},[r("vs-th",[t._v("ลำดับ")]),r("vs-th",[t._v("ชื่อตำแหน่ง")]),r("vs-th",[t._v("รายละเอียด")]),r("vs-th")],1)],2)],1)},U=[],W={name:"product-basic",data:function(){return{users:[{id:1,name:"รถไถนารุ่นที่ 1",des:"40 แรงม้า (29.4 กิโลวัตต์) ที่ 2,700 รอบต่อนาที"},{id:2,name:"รถไถนารุ่นที่ 2",des:"40 แรงม้า (29.4 กิโลวัตต์) ที่ 2,700 รอบต่อนาที"},{id:3,name:"อะไหล่",des:"40 แรงม้า"}],value1:"",value2:"",popupActive2:!1,popupActive3:!1}}},B=W,F=Object(v["a"])(B,I,U,!1,null,null,null),G=F.exports,J=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("vx-card",[r("div",{staticClass:"vx-row"},[r("div",{staticClass:"vx-col w-4/12"},[r("custom-tree",{ref:"tree",attrs:{url:"/api/setting/master/customer",col:12},on:{onClick:t.onClick,onDelete:t.onDelete}})],1),r("div",{staticClass:"vx-col w-8/12"},[r("panel",{directives:[{name:"show",rawName:"v-show",value:t.openform,expression:"openform"}],attrs:{title:"ตั้งค่า"}},[r("setting-form",{ref:"form",on:{clickSubmit:t.clickSubmit}})],1)],1)])])},M=[],P=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"vx-row"},[r("div",{staticClass:"vx-col sm:w-full"},[r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"Thai","data-vv-as":"Title",col:12},model:{value:t.form.name_th,callback:function(e){t.$set(t.form,"name_th",e)},expression:"form.name_th"}})],1)]),r("div",{staticClass:"vx-row"},[r("div",{staticClass:"vx-col sm:w-full"},[r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"Eng","data-vv-as":"Title",col:12},model:{value:t.form.name_en,callback:function(e){t.$set(t.form,"name_en",e)},expression:"form.name_en"}})],1)]),r("vs-row",[r("vs-col",{attrs:{"vs-type":"flex","vs-justify":"flex-end","vs-align":"center"}},[r("vs-button",{staticClass:"mr-3",on:{click:function(e){return t.clickSubmit()}}},[t._v("บันทึก")]),r("router-link",{attrs:{to:"/product/checkWarehouse"}},[r("vs-button",{attrs:{color:"danger",type:"filled"}},[t._v("ยกเลิก")])],1)],1)],1)],1)},H=[],z={data:function(){return{form:{}}},methods:{clickSubmit:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){var e,r;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(this.form.id){t.next=19;break}return t.prev=1,t.next=4,this.$validator.validateAll();case 4:if(e=t.sent,!e){t.next=10;break}return t.next=8,this.$vs.dialog({type:"confirm",color:"success",title:"คุณต้องการเพิ่มข้อมูลหรือไม่",text:"เพิ่มข้อมูลระดับสมาชิก ".concat(this.form.name_th,"(").concat(this.form.name_en,")"),acceptText:"ยืนยัน",cancelText:"ยกเลิก",accept:this.acceptInsert});case 8:t.next=12;break;case 10:return t.next=12,this.$vs.dialog({color:"danger",title:"สถานะการเพิ่มข้อมูล",text:"เพิ่มข้อมูลระดับสมาชิกไม่สำเร็จ",acceptText:"ปิด"});case 12:t.next=17;break;case 14:t.prev=14,t.t0=t["catch"](1),console.log("err",t.t0);case 17:t.next=29;break;case 19:return t.prev=19,t.next=22,this.$validator.validateAll();case 22:r=t.sent,r?this.$vs.dialog({type:"confirm",color:"success",title:"แก้ข้อมูลสำเร็จ",text:"แก้ไขข้อมูลระดับสมาชิก  ".concat(this.form.name_th,"(").concat(this.form.name_en,")"),acceptText:"ยืนยัน",cancelText:"ยกเลิก",accept:this.acceptAlert}):this.$vs.dialog({color:"danger",title:"แก้ข้อมูลไม่สำเร็จ",text:"กรุณาตรวจสอบการกรอกข้อมูลให้ครบถ้วน",acceptText:"ปิด",accept:this.acceptAlertFail}),t.next=29;break;case 26:t.prev=26,t.t1=t["catch"](19),this.$vs.dialog({color:"danger",title:"แก้ข้อมูลไม่สำเร็จ",text:"กรุณาตรวจสอบการกรอกข้อมูลให้ครบถ้วน",acceptText:"ปิด",accept:this.acceptAlertFail});case 29:case"end":return t.stop()}}),t,this,[[1,14],[19,26]])})));function e(){return t.apply(this,arguments)}return e}(),acceptAlert:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,this.$http.patch("/api/setting/master/customer/".concat(this.form.id),this.form);case 2:this.$vs.notify({color:"success",title:"แก้ไขข้อมูล",text:"แก้ไขข้อมูลระดับสมาชิกกสำเร็จ"}),this.$emit("clickSubmit",this.form.name_th="",this.form.name_en="");case 4:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),acceptAlertFail:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:this.$vs.notify({color:"danger",title:"แก้ไขข้อมูลไม่สำเร็จ",text:"แก้ไขข้อมูลระดับสมาชิกไม่สำเร็จ"});case 1:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),acceptInsert:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,this.$http.post("/api/setting/master/customer/",this.form);case 3:return t.next=5,this.$vs.notify({color:"success",title:"ยืนยันการเพิ่มข้อมูล",text:"เพิ่มข้อมูลสำเร็จ"});case 5:this.$emit("clickSubmit",this.form.name_th="",this.form.name_en=""),t.next=11;break;case 8:throw t.prev=8,t.t0=t["catch"](0),t.t0;case 11:case"end":return t.stop()}}),t,this,[[0,8]])})));function e(){return t.apply(this,arguments)}return e}()}},K=z,Q=Object(v["a"])(K,P,H,!1,null,null,null),V=Q.exports,X={components:{"setting-form":V},data:function(){return{clickData:null,openform:null,node:"",parent:"",index:""}},mounted:function(){},methods:{onClick:function(t){this.clickData=t,this.openform=!0,this.$refs.form.form=t},onDelete:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(e,r,n){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:this.node=e,this.parent=r,this.index=n,this.$vs.dialog({type:"confirm",color:"danger",title:"ต้องการลบรายการนี้หรือไม่ ?",acceptText:"ยืนยัน",cancelText:"ยกเลิก",text:"คุณแน่ใจหรือไม่ว่าต้องการลบ ".concat(this.node.name_th,"{").concat(this.node.name_en,"}"),accept:this.deleteAlert});case 4:case"end":return t.stop()}}),t,this)})));function e(e,r,n){return t.apply(this,arguments)}return e}(),deleteAlert:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,this.$http.delete("/api/setting/master/customer/".concat(this.node.id));case 2:this.$vs.notify({color:"success",title:"ลบข้อมูล",text:"ลบข้อมูลระดับสมาชิกกสำเร็จ"}),this.$refs.tree.removeNode(this.node,this.parent,this.index);case 4:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),clickSubmit:function(t){console.log(t),this.$refs.tree.refresh()}}},Y=X,Z=Object(v["a"])(Y,J,M,!1,null,null,null),tt=Z.exports,et=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("vx-card",[r("div",{staticClass:"vx-row"},[r("div",{staticClass:"vx-col w-4/12"},[r("custom-tree",{ref:"tree",attrs:{url:"/api/setting/master/product"},on:{onClick:t.onClick,onDelete:t.onDelete}})],1),r("div",{staticClass:"vx-col w-8/12"},[r("setting-form",{directives:[{name:"show",rawName:"v-show",value:t.openform,expression:"openform"}],ref:"form",on:{clickSubmit:t.clickSubmit,reload:t.reload}})],1)])])},rt=[],nt=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("panel",[r("div",{staticClass:"vx-row mb-6"},[null!==t.form.ref_id?r("div",{staticClass:"centerx vx-col sm:w-2/3 w-full"},[r("vs-radio",{attrs:{"vs-value":"ต่อพ่วง"},model:{value:t.form.type,callback:function(e){t.$set(t.form,"type",e)},expression:"form.type"}},[t._v("ต่อพ่วง")]),t._v("\n       \n\n      "),r("vs-radio",{attrs:{"vs-value":"อะไหล่"},model:{value:t.form.type,callback:function(e){t.$set(t.form,"type",e)},expression:"form.type"}},[t._v("อะไหล่")]),t._v("\n       \n\n      "),r("vs-radio",{attrs:{"vs-value":"ตัวรถ"},model:{value:t.form.type,callback:function(e){t.$set(t.form,"type",e)},expression:"form.type"}},[t._v("ตัวรถ")])],1):t._e(),r("div",{staticClass:"vx-col w-full"},[r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"ชื่อ (TH)","data-vv-as":"Title",col:12},model:{value:t.form.name_th,callback:function(e){t.$set(t.form,"name_th",e)},expression:"form.name_th"}})],1)]),r("div",{staticClass:"vx-row mb-6"},[r("div",{staticClass:"vx-col w-full"}),r("div",{staticClass:"vx-col w-full"},[r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"ชื่อ (EN)","data-vv-as":"Title",col:12},model:{value:t.form.name_en,callback:function(e){t.$set(t.form,"name_en",e)},expression:"form.name_en"}})],1)]),r("div",{staticClass:"vx-row mb-6"},[r("div",{staticClass:"vx-col w-full"}),r("div",{staticClass:"vx-col w-full"},[null!==t.form.ref_id?r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"ราคาขายปลีก","data-vv-as":"Title",col:12},model:{value:t.form.retail_price,callback:function(e){t.$set(t.form,"retail_price",e)},expression:"form.retail_price"}}):t._e()],1)]),r("div",{staticClass:"vx-row mb-6"}),r("div",{staticClass:"vx-row"},[r("vs-col",{attrs:{"vs-type":"flex","vs-justify":"flex-end","vs-align":"center"}},[r("vs-button",{staticClass:"mr-3",on:{click:function(e){return t.openAlert()}}},[t._v("บันทึก")]),r("router-link",{attrs:{to:"/product/checkWarehouse"}},[r("vs-button",{attrs:{color:"danger",type:"filled"}},[t._v("ยกเลิก")])],1)],1)],1)])},at=[],st={data:function(){return{form:{type:"",retail_price:"ss"}}},methods:{openAlert:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:this.clickSubmit();case 1:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),clickSubmit:function(){this.form.id?(this.$emit("clickSubmit",this.form),this.$vs.dialog({type:"confirm",color:"success",title:"คุณต้องการแก้ไขข้อมูลตั่งค่าหรือไม่",text:"เพิ่มข้อมูลสินค้า  ".concat(this.form.name_th),acceptText:"ยืนยัน",cancelText:"ยกเลิก",accept:this.acceptUpdate}),this.updateNode(),console.log("edit")):(this.$emit("clickSubmit",this.form),this.$vs.dialog({type:"confirm",color:"success",title:"คุณต้องการเพิ่มข้อมูลหรือไม่",text:"เพิ่มข้อมูลสินค้า  ".concat(this.form.name_th),acceptText:"ยืนยัน",cancelText:"ยกเลิก",accept:this.acceptAdd}),console.log("add"))},acceptAdd:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){var e;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,this.$http.post("/api/setting/master/product",this.form);case 2:return e=t.sent,console.log(e),t.next=6,this.$vs.notify({color:"success",title:"ยืนยันการเพิ่มข้อมูล",text:"เพิ่มข้อมูลสำเร็จ"});case 6:this.$emit("reload");case 7:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),acceptUpdate:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){var e;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,this.$http.patch("/api/setting/master/product/".concat(this.form),this.form);case 2:return e=t.sent,console.log(e),t.next=6,this.$vs.notify({color:"success",title:"ยืนยันการแก้ไขข้อมูลข้อมูล",text:"แก้ไขข้อมูลสำเร็จ"});case 6:this.$emit("reload");case 7:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}()}},it=st,ct=Object(v["a"])(it,nt,at,!1,null,null,null),ot=ct.exports,lt={components:{"setting-form":ot},data:function(){return{clickData:null,openform:!1}},mounted:function(){},methods:{onClick:function(t){this.clickData=t,this.openform=!0,this.$refs.form.form=t},onDelete:function(t,e,r){this.node=t,this.parent=e,this.index=r,console.log(t),this.$refs.tree.removeNode(t,e,r),this.$vs.dialog({type:"confirm",color:"danger",title:"ต้องการลบรายการนี้หรือไม่ ?",acceptText:"ยืนยัน",cancelText:"ยกเลิก",text:"คุณแน่ใจหรือไม่ว่าต้องการลบ ".concat(this.node.name_th),accept:this.acceptAlert})},clickSubmit:function(t){console.log(t),this.$refs.tree.refresh()},reload:function(){this.$refs.tree.refresh()},acceptAlert:function(){var t=Object(T["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,this.$http.delete("api/setting/master/product/".concat(this.node.id," "));case 3:return t.next=5,this.loadData();case 5:t.next=9;break;case 7:t.prev=7,t.t0=t["catch"](0);case 9:this.$vs.notify({color:"success",title:"ลบสำเร็จ",text:"บันทึกข้อมูล"});case 10:case"end":return t.stop()}}),t,this,[[0,7]])})));function e(){return t.apply(this,arguments)}return e}()}},ut=lt,vt=Object(v["a"])(ut,et,rt,!1,null,null,null),mt=vt.exports,ft={components:{EmployeeGeneral:x,MemberGeneral:y,ProductGeneral:G,EmployeeBasic:L,MemberBasic:tt,ProductBasic:mt}},pt=ft,dt=Object(v["a"])(pt,n,a,!1,null,null,null);e["default"]=dt.exports}}]);
//# sourceMappingURL=chunk-2d0ab897.1df1f734.js.map