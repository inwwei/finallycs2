(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0c4dd7"],{"3d3c":function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("panel",{attrs:{title:"ข้อมูลพนักงานทั้งหมด"},scopedSlots:t._u([{key:"header-right",fn:function(){return[r("router-link",{attrs:{to:"/employee/AddEmployee"}},[r("vs-button",{attrs:{color:"primary",type:"filled"}},[t._v("เพิ่มข้อมูล")])],1)]},proxy:!0}])},[r("vs-table",{attrs:{pagination:"","max-items":"5",search:"",data:t.users},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.data;return t._l(n,(function(e,a){return r("vs-tr",{key:a},[r("vs-td",[t._v("\n            "+t._s(n[a].code)+"\n          ")]),r("vs-td",[t._v("\n            "+t._s(n[a].name)+"\n          ")]),r("vs-td",[t._v("\n            "+t._s(n[a].setting_master_user.name_th)+"\n          ")]),r("vs-td",[t._v("\n            "+t._s(n[a].branch)+"\n          ")]),r("vs-td",[r("div",{staticClass:"flex mb-3",attrs:{align:"center"}},[r("div",{staticClass:"w-1/6 bg-grid-color-secondary h-12"},[r("vs-button",{attrs:{color:"primary",type:"flat","icon-pack":"feather",icon:"icon-search"},on:{click:function(e){return t.personalHistory(n[a])}}})],1),r("div",{staticClass:"w-1/6 bg-grid-color h-12"},[r("vs-button",{attrs:{color:"warning",type:"flat","icon-pack":"feather",icon:"icon-edit"},on:{click:function(e){return t.editData(n[a])}}})],1),r("div",{staticClass:"w-1/6 bg-grid-color h-12"},[r("vs-button",{attrs:{color:"danger",type:"flat","icon-pack":"feather",icon:"icon-trash"},on:{click:function(e){return t.openConfirm(n[a])}}})],1),r("div",{staticClass:"w-1/6 bg-grid-color-secondary h-12"})])])],1)}))}}])},[r("template",{slot:"header"}),r("template",{slot:"thead"},[r("vs-th",[t._v("รหัสพนักงาน")]),r("vs-th",[t._v("ชื่อ")]),r("vs-th",[t._v("ตำแหน่ง")]),r("vs-th",[t._v("สาขา")]),r("vs-th")],1)],2)],1)],1)},a=[],s=(r("7f7f"),r("96cf"),r("3b8d")),i={data:function(){return{users:[],deleteUser:null}},methods:{loadData:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var e,r;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,this.$http.get("/api/user");case 3:e=t.sent,r=e.data,this.users=r.data,t.next=11;break;case 8:throw t.prev=8,t.t0=t["catch"](0),t.t0;case 11:case"end":return t.stop()}}),t,this,[[0,8]])})));function e(){return t.apply(this,arguments)}return e}(),personalHistory:function(t){this.$router.push({name:"user_history",query:{id:t.id}})},editData:function(t){this.$router.push({name:"user_edit",query:{id:t.id}})},openConfirm:function(t){this.deleteUser=t,this.$vs.dialog({type:"confirm",color:"danger",title:"คุณต้องการลบข้อมูลใช่หรือไม่",text:"ลบข้อมูลพนักงานชื่อ ".concat(this.deleteUser.name),accept:this.acceptDelete,acceptText:"ยืนยัน",cancelText:"ยกเลิก"})},acceptDelete:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,this.$http.delete("/api/user/".concat(this.deleteUser.id));case 3:return t.next=5,this.loadData();case 5:t.next=10;break;case 7:throw t.prev=7,t.t0=t["catch"](0),t.t0;case 10:return t.next=12,this.$vs.notify({color:"danger",title:"ยืนยันการลบข้อมูล",text:"ลบข้อมูลสำเร็จ"});case 12:case"end":return t.stop()}}),t,this,[[0,7]])})));function e(){return t.apply(this,arguments)}return e}()},mounted:function(){this.loadData()}},c=i,o=r("2877"),u=Object(o["a"])(c,n,a,!1,null,null,null);e["default"]=u.exports}}]);
//# sourceMappingURL=chunk-2d0c4dd7.92d4f47a.js.map