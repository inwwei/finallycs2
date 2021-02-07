export default [
  {
    path: '/customer/Index',
    name: 'customerIndex',
    component: () => import('@/views/customer/Index.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสมาชิก',
        },
        {
          text: 'ข้อมูลสมาชิกทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/customer/Add',
    name: 'customerAdd',
    component: () => import('@/views/customer/Add.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสมาชิก',
        },
        {
          text: 'ข้อมูลสมาชิกทั้งหมด',
          to: { name: 'customerIndex' },
        },
        {
          text: 'เพิ่มข้อมูลสมาชิก',
          active: true,
        },
      ],
    },
  },
  {
    path: '/customer/Info',
    name: 'customerInfo',
    component: () => import('@/views/customer/Info.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสมาชิก',
        },
        {
          text: 'ข้อมูลสมาชิกทั้งหมด',
          to: { name: 'customerIndex' },
        },
        {
          text: 'ข้อมูลสมาชิก',
          active: true,
        },
      ],
    },
  },
  {
    path: '/customer/Edit',
    name: 'customerEdit',
    component: () => import('@/views/customer/Edit.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสมาชิก',
        },
        {
          text: 'ข้อมูลสมาชิกทั้งหมด',
          to: { name: 'customerIndex' },
        },
        {
          text: 'แก้ไขข้อมูลสมาชิก',
          active: true,
        },
      ],
    },
  },
]
