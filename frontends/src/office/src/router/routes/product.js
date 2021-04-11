export default [
//   {
//     path: '/Registers',
//     name: 'Registers',
//     component: () => import('@/views/pages/authentication/Register-v1.vue'),
//     meta: {
//       breadcrumb: [
//         {
//           text: 'รายการประกาศรับซื้อ',
//           active: true,
//         },

  //       ],
  //     },
  //   },

  {
    path: '/product/TenderNotice',
    name: 'TenderNotice',
    component: () => import('@/views/product/TenderNotice.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'รายการประกาศรับซื้อ',
          active: true,
        },

      ],
    },
  },
  {
    path: '/product/Pricechart',
    name: 'Pricechart',
    component: () => import('@/views/product/Pricechart.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'กราฟราคา',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/CompanyRegistered',
    name: 'CompanyRegistered',
    component: () => import('@/views/product/CompanyRegistered.vue'),
    meta: {
      breadcrumb: [

        {
          text: 'บริษัทที่ลงทะเบียนในระบบ',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/Ranking',
    name: 'Ranking',
    component: () => import('@/views/product/Ranking.vue'),
    meta: {
      breadcrumb: [

        {
          text: 'อันดับการเติบโตของราคา',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/MinistryOfCommerceInformation',
    name: 'MinistryOfCommerceInformation',
    component: () => import('@/views/product/MinistryOfCommerceInformation.vue'),
    meta: {
      breadcrumb: [

        {
          text: 'ข้อมูลจากกระทรวงพาณิชย์',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/ManageShop',
    name: 'ManageShop',
    component: () => import('@/views/product/ManageShop.vue'),
    meta: {
      breadcrumb: [

        {
          text: 'จัดการร้าน',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/WhatToPlant',
    name: 'WhatToPlant',
    component: () => import('@/views/product/WhatToPlant.vue'),
    meta: {
      breadcrumb: [

        {
          text: 'พืชยอดนิยม',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/ManageShop/Menu',
    name: 'Menu',
    component: () => import('@/views/product/Menu.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'จัดการร้าน',
        },
        {
          text: 'ประกาศ',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/ManageShop/Profiles',
    name: 'Profiles',
    component: () => import('@/views/product/Profiles.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'จัดการร้าน',
        },
        {
          text: 'ข้อมูลร้าน',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/Info',
    name: 'productInfo',
    component: () => import('@/views/product/Info'),
    meta: {
      breadcrumb: [
        {
          text: 'ร้านที่ลงทะเบียน',
        },
        {
          text: 'ข้อมูลร้าน',
          active: true,
        },
      ],
    },
  },
]
