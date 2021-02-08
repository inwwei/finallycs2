export default [
  {
    title: 'Page Home',
    route: 'home',
    icon: 'MapIcon',
  },
  {
    header: 'System',
  },
  {
    title: 'Product',
    icon: 'ShoppingCartIcon',
    children: [

      {
        title: 'Tender Notice',
        route: 'TenderNotice',
      },
      {
        title: 'Price chart',
        route: 'Pricechart',
      },
      {
        title: 'Company registered',
        route: 'CompanyRegistered',
      },
      {
        title: 'Ministry of Commerce information',
        route: 'MinistryOfCommerceInformation',
      },
      {
        title: 'Manage shop',
        route: 'ManageShop',

        children: [
          {
            title: 'Menu',
            route: 'Menu',
          },
          {
            title: 'Profiles',
            route: 'Profiles',
          },
        ],
      },
    ],
  },
]
