(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-743f67ea"],{"07e35":function(t,e,r){"use strict";r.r(e);var a=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("panel",{attrs:{title:"เพิ่มข้อมูลสมาชิก"}},[r("br"),r("p",[t._v("เพิ่มข้อมูลสมาชิก")]),r("div",{staticClass:"vx-row"},[r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"ชื่อ-นามสกุล",col:4},model:{value:t.form.customer_name,callback:function(e){t.$set(t.form,"customer_name",e)},expression:"form.customer_name"}}),r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"ที่อยู่",col:4},model:{value:t.form.customer_address,callback:function(e){t.$set(t.form,"customer_address",e)},expression:"form.customer_address"}}),r("custom-tree-select",{staticClass:"my-5",attrs:{url:"/api/setting/master/customer",col:4},model:{value:t.form.setting_master_customer_id,callback:function(e){t.$set(t.form,"setting_master_customer_id",e)},expression:"form.setting_master_customer_id"}}),r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"สาขา",col:4},model:{value:t.form.customer_branch,callback:function(e){t.$set(t.form,"customer_branch",e)},expression:"form.customer_branch"}})],1),r("div",{attrs:{align:"right"}},[r("vs-button",{attrs:{color:"primary",type:"filled"},on:{click:function(e){t.addContact=!0}}},[t._v("เพิ่ม")]),r("vs-prompt",{attrs:{title:"เพิ่มข้อมูลติดต่อ",color:"primary","is-valid":t.validName,active:t.addContact,acceptText:"ยืนยัน",cancelText:"ยกเลิก"},on:{cancel:t.clearValMultiple,accept:t.acceptInsertContact,close:t.close,"update:active":function(e){t.addContact=e}}},[r("div",{staticClass:"con-exemple-prompt"},[r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"ประเภท",col:12},model:{value:t.tempContact.type,callback:function(e){t.$set(t.tempContact,"type",e)},expression:"tempContact.type"}}),r("form-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"`required`"}],attrs:{label:"ข้อมูลติดต่อ",col:12},model:{value:t.tempContact.value,callback:function(e){t.$set(t.tempContact,"value",e)},expression:"tempContact.value"}})],1)])],1),r("vs-table",{attrs:{pagination:"","max-items":"5",search:"",data:t.form.customer_contact},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.data;return t._l(a,(function(e,a){return r("vs-tr",{key:a},[r("vs-td",[t._v("\n              "+t._s(a+1)+"\n            ")]),r("vs-td",[t._v("\n              "+t._s(t.form.customer_contact[a].value)+"\n            ")]),r("vs-td",[t._v("\n              "+t._s(t.form.customer_contact[a].type)+"\n            ")]),r("vs-td",[r("div",{staticClass:"flex mb-3",attrs:{align:"center"}},[r("div",{staticClass:"w-1/6 bg-grid-color h-12"},[r("vs-button",{attrs:{radius:"",color:"danger",type:"flat","icon-pack":"feather",icon:"icon-trash"},on:{click:function(e){return t.openConfirmDelete(a)}}})],1),r("div",{staticClass:"w-1/6 bg-grid-color-secondary h-12"})])])],1)}))}}])},[r("template",{slot:"thead"},[r("vs-th",[t._v("ลำดับ")]),r("vs-th",[t._v("ข้อมูลติดต่อ")]),r("vs-th",[t._v("ประเภท")]),r("vs-th")],1)],2),r("p",[t._v("แนบไฟล์")]),r("div",{staticClass:"flex mb-4"},[r("attached",{ref:"upload",attrs:{id:t.data_id,model:t.data_model}})],1),r("div",{staticClass:"vx-row"},[r("div",{staticClass:"vx-col sm:w-/3 w-full ml-auto",attrs:{align:"right"}},[r("vs-button",{attrs:{color:"primary",size:"medium",type:"filled"},on:{click:function(e){return t.insertCustomer()}}},[t._v("ยืนยัน")]),t._v(" \n          "),r("router-link",{attrs:{to:"/member/index"}},[r("vs-button",{staticClass:"mb-2",attrs:{color:"danger",type:"filled"}},[t._v("ยกเลิก")])],1)],1)])],1),r("br")],1)},n=[],s=(r("8e6e"),r("ac6a"),r("456d"),r("bd86")),c=(r("96cf"),r("3b8d")),o=r("4a7a"),i=r.n(o);function l(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,a)}return r}function u(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?l(Object(r),!0).forEach((function(e){Object(s["a"])(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):l(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}var m={components:{"v-select":i.a},data:function(){return{addContact:!1,valMultipe:{value1:"",value2:""},data_id:"",data_model:"App\\Models\\Customer",form:{code:"1234",customer_name:"",customer_address:"",customer_branch:"",setting_master_customer_id:"",customer_contact:[]},settingCustomer:[],tempContact:{type:"",value:""}}},computed:{validName:function(){return this.tempContact.type.length>0&&this.tempContact.value.length>0}},methods:{insertCustomer:function(){var t=Object(c["a"])(regeneratorRuntime.mark((function t(){var e;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,this.$validator.validateAll();case 3:if(e=t.sent,!e){t.next=9;break}return t.next=7,this.$vs.dialog({type:"confirm",color:"success",title:"คุณต้องการเพิ่มข้อมูลหรือไม่",text:"เพิ่มข้อมูลสมาชิกชื่อ ".concat(this.form.customer_name),acceptText:"ยืนยัน",cancelText:"ยกเลิก",accept:this.acceptInsertTest});case 7:t.next=11;break;case 9:return t.next=11,this.$vs.dialog({color:"danger",title:"สถานะการเพิ่มข้อมูล",text:"เพิ่มข้อมูลพนักงานไม่สำเร็จ",acceptText:"ปิด"});case 11:t.next=16;break;case 13:t.prev=13,t.t0=t["catch"](0),console.log("err",t.t0);case 16:case"end":return t.stop()}}),t,this,[[0,13]])})));function e(){return t.apply(this,arguments)}return e}(),acceptInsertTest:function(){var t=Object(c["a"])(regeneratorRuntime.mark((function t(){var e,r;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,this.$http.post("/api/customers",this.form);case 3:return e=t.sent,this.data_id=e.data.data.id,this.$refs.upload.id=e.data.data.id,t.next=8,this.$refs.upload.submit();case 8:return r=t.sent,console.log(r),t.next=12,this.$vs.notify({color:"success",title:"ยืนยันการเพิ่มข้อมูล",text:"เพิ่มข้อมูลสำเร็จ"});case 12:return t.next=14,this.$router.push({name:"customer_index",query:{}});case 14:t.next=19;break;case 16:throw t.prev=16,t.t0=t["catch"](0),t.t0;case 19:case"end":return t.stop()}}),t,this,[[0,16]])})));function e(){return t.apply(this,arguments)}return e}(),openConfirmDelete:function(t){this.tempDeleteIndex=t,this.deleteCustomerContact=this.form.customer_contact[t].value,this.$vs.dialog({type:"confirm",color:"danger",title:"คุณต้องการลบข้อมูลใช่หรือไม่",text:"ลบข้อมูลติดต่อ ".concat(this.deleteCustomerContact),accept:this.acceptDelete,acceptText:"ยืนยัน",cancelText:"ยกเลิก"})},acceptDelete:function(){var t=Object(c["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.form.customer_contact.splice(this.tempDeleteIndex,1),t.next=3,this.$vs.notify({color:"danger",title:"ยืนยันการลบข้อมูล",text:"ลบข้อมูลสำเร็จ"});case 3:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),acceptInsertContact:function(){this.form.customer_contact.push(u({},this.tempContact)),this.$vs.notify({color:"success",title:"ยืนยันการเพิ่มข้อมูล",text:"เพิ่มข้อมูลสำเร็จ"}),this.tempContact.type="",this.tempContact.value=""},acceptAlert2:function(){this.$vs.notify({color:"success",title:"สำเร็จ",text:"เพิ่มข้อมูลติดต่อสำเร็จ"})},close:function(){this.$vs.notify({color:"danger",title:"ยกเลิก",text:"ยกเลิกการเพิ่มข้อมูลติดต่อ"})},clearValMultiple:function(){this.tempContact.type="",this.tempContact.value=""},acceptAlert:function(){var t=Object(c["a"])(regeneratorRuntime.mark((function t(){var e,r;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,this.$http.post("/api/customers/",this.form);case 2:return e=t.sent,this.data_id=e.data.data.id,this.$refs.test.id=e.data.data.id,t.next=7,this.$refs.test.submit();case 7:r=t.sent,console.log(r),this.$router.push({name:"customer_index",query:{}});case 10:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}()},mounted:function(){}},d=m,p=r("2877"),v=Object(p["a"])(d,a,n,!1,null,null,null);e["default"]=v.exports}}]);
//# sourceMappingURL=chunk-743f67ea.bdbb9a62.js.map