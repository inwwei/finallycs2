(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-6c90ee74"],{b735:function(n,t,e){"use strict";e("c1dc")},c1dc:function(n,t,e){},ff9d:function(n,t,e){"use strict";e.r(t);var a=function(){var n=this,t=n.$createElement,e=n._self._c||t;return e("div",{attrs:{id:"invoice-page"}},[e("vx-card",{attrs:{id:"invoice-container"}},[e("div",{staticClass:"vx-row leading-loose p-base"},[e("div",{staticClass:"vx-col w-full md:w-1/2 mt-base"},[e("img",{attrs:{src:"https://iseki.co.th/wp-content/uploads/2018/06/2000px-Iseki_company_logo.svg.png",width:"20%",alt:"vuexy-logo"}})]),e("div",{staticClass:"vx-col w-full md:w-1/2 text-right"},[e("div",{staticClass:"invoice__invoice-detail mt-6"},[e("h6",[n._v("ใบสั่งจองเลขที่")]),e("p",[n._v("#BYAI000016891")]),e("h6",{staticClass:"mt-4"},[n._v("วันที่")]),e("p",[n._v("4 ตุลาคม 2563")])])])]),e("div",{staticClass:"p-base"},[e("vs-table",{attrs:{hoverFlat:"",data:n.invoiceData.tasks}})],1),[e("vx-card",{attrs:{"code-toggler":""}},[e("vs-table",{attrs:{data:n.users},scopedSlots:n._u([{key:"default",fn:function(t){var a=t.data;return n._l(a,(function(t,i){return e("vs-tr",{key:i},[e("vs-td",{attrs:{data:a[i].id}},[n._v("\n              "+n._s(a[i].id)+"\n            ")]),e("vs-td",{attrs:{data:a[i].username}},[n._v("\n              "+n._s(a[i].name)+"\n            ")]),e("vs-td",{attrs:{data:a[i].id}},[n._v("\n              "+n._s(a[i].website)+"\n            ")]),e("vs-td",{attrs:{data:a[i].total}},[n._v("\n              "+n._s(a[i].total)+"\n            ")]),e("vs-td",{attrs:{data:a[i].total}},[n._v("\n              "+n._s(a[i].total)+"\n            ")])],1)}))}}])},[e("template",{slot:"thead"},[e("vs-th",[n._v("ชื่อ")]),e("vs-th",[n._v("วันที่")]),e("vs-th",[n._v("รายการ")]),e("vs-th",[n._v("จำนวน")]),e("vs-th",[n._v("ราคาทั้งหมด")])],1)],2),e("template",{slot:"codeContainer"},[n._v('\n<template>\n  <vs-table :data="users">\n\n    <template slot="thead">\n      <vs-th>Email</vs-th>\n      <vs-th>Name</vs-th>\n      <vs-th>Website</vs-th>\n      <vs-th>Nro</vs-th>\n    </template>\n\n    <template slot-scope="{data}">\n      <vs-tr :key="indextr" v-for="(tr, indextr) in data">\n\n        <vs-td :data="data[indextr].id">\n          '+n._s("{{ data[indextr].id }}")+'\n        </vs-td>\n\n        <vs-td :data="data[indextr].username">\n          '+n._s("{{ data[indextr].name }}")+'\n        </vs-td>\n\n        <vs-td :data="data[indextr].id">\n          '+n._s("{{ data[indextr].website }}")+'\n        </vs-td>\n\n        <vs-td :data="data[indextr].id">\n          '+n._s("{{ data[indextr].id }}")+'\n        </vs-td>\n\n        <vs-td :data="data[indextr].total">\n          '+n._s("{{ data[indextr].total }}")+'\n        </vs-td>\n\n      </vs-tr>\n    </template>\n\n  </vs-table>\n</template>\n\n<script>\nexport default {\n  data() {\n    return {\n      users: [\n        {\n          "id": 1,\n          "name": "Leanne Graham",\n          "username": "Bret",\n          "email": "Sincere@april.biz",\n          "website": "hildegard.org",\n        },\n        {\n          "id": 2,\n          "name": "Ervin Howell",\n          "username": "Antonette",\n          "email": "Shanna@melissa.tv",\n          "website": "anastasia.net",\n        },\n        {\n          "id": 3,\n          "name": "Clementine Bauch",\n          "username": "Samantha",\n          "email": "Nathan@yesenia.net",\n          "website": "ramiro.info",\n        },\n        {\n          "id": 4,\n          "name": "Patricia Lebsack",\n          "username": "Karianne",\n          "email": "Julianne.OConner@kory.org",\n          "website": "kale.biz",\n        },\n        {\n          "id": 5,\n          "name": "Chelsey Dietrich",\n          "username": "Kamren",\n          "email": "Lucio_Hettinger@annie.ca",\n          "website": "demarco.info",\n        },\n        {\n          "id": 6,\n          "name": "Mrs. Dennis Schulist",\n          "username": "Leopoldo_Corkery",\n          "email": "Karley_Dach@jasper.info",\n          "website": "ola.org",\n        },\n        {\n          "id": 7,\n          "name": "Kurtis Weissnat",\n          "username": "Elwyn.Skiles",\n          "email": "Telly.Hoeger@billy.biz",\n          "website": "elvis.io",\n        },\n        {\n          "id": 8,\n          "name": "Nicholas Runolfsdottir V",\n          "username": "Maxime_Nienow",\n          "email": "Sherwood@rosamond.me",\n          "website": "jacynthe.com",\n        },\n        {\n          "id": 9,\n          "name": "Glenna Reichert",\n          "username": "Delphine",\n          "email": "Chaim_McDermott@dana.io",\n          "website": "conrad.com",\n        },\n        {\n          "id": 10,\n          "total": 10,\n          "name": "Clementina DuBuque",\n          "username": "Moriah.Stanton",\n          "email": "Rey.Padberg@karina.biz",\n          "website": "ambrose.net",\n        },\n      ]\n    }\n  },\n}\n<\/script>\n        ')]),e("br"),e("br"),e("legend",[n._v("ราคารวม 762,500 บาท")])],2)],e("br"),e("br"),e("br"),e("br"),e("legend",[n._v("(---------------------------) (หัวหน้าสาขา)")]),e("br"),e("br"),e("legend",[n._v("(---------------------------) (เจ้าหน้าที่รับผิดชอบ)")]),e("br"),e("br")],2),e("div",{staticClass:"flex flex-wrap items-center justify-between"},[e("vx-input-group",{staticClass:"mb-base mr-3"}),e("div",{staticClass:"flex items-center"},[e("vs-button",{staticClass:"mb-base mr-3",attrs:{type:"border","icon-pack":"feather",icon:"icon icon-download"}},[n._v("Download")]),e("vs-button",{staticClass:"mb-base mr-3",attrs:{"icon-pack":"feather",icon:"icon icon-file"},on:{click:n.printInvoice}},[n._v("Print")])],1)],1)],1)},i=[],s={data:function(){return{tableList:["vs-th: Component","vs-tr: Component","vs-td: Component","thread: Slot","tbody: Slot","header: Slot"],users:[{id:1,total:"2,500",name:"2020-10-28",username:"Bret",email:"นายจิรพัฒน์ บัวรอด",website:"แทคเตอร์"},{id:2,total:"50,000",name:"2020-10-28",username:"Antonette",email:"นายจิรภัทร ยืนยิ่ง",website:"รถเกี่ยวนวดข้าว"},{id:3,total:"10,000",name:"2020-10-28",username:"Samantha",email:"นางสาวจุฑามาส อุประ",website:"อุปกรณ์เสิรม"},{id:4,total:"100,000",name:"2020-10-28",username:"Karianne",email:"นายเจตนิน แสงชัจจ์",website:"รถไถ่"},{id:5,total:"600,000",name:"2020-10-28",username:"Kamren",email:"นายชยาพัฒน์ เซี่ยงใช่",website:"รถปลูก"}],mailTo:"",companyDetails:{},recipientDetails:{},invoiceDetails:{invoiceNo:"001/2019",invoiceDate:"Mon Dec 10 2018 07:46:00 GMT+0000 (GMT)"},invoiceData:{tasks:[{}],subtotal:114e3,discountPercentage:5,discountedAmount:5700,total:108300}}},computed:{},methods:{printInvoice:function(){window.print()}},components:{},mounted:function(){this.$emit("setAppClasses","invoice-page")}},r=s,o=(e("b735"),e("2877")),d=Object(o["a"])(r,a,i,!1,null,null,null);t["default"]=d.exports}}]);
//# sourceMappingURL=chunk-6c90ee74.021cb584.js.map