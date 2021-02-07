/*

Array of object

Top level object can be:
1. Header
2. Group (Group can have navItems as children)
3. navItem

* Supported Options

/--- Header ---/

header

/--- nav Grp ---/

title
icon (if it's on top level)
tag
tagVariant
children

/--- nav Item ---/

icon (if it's on top level)
title
route: [route_obj/route_name] (I have to resolve name somehow from the route obj)
tag
tagVariant

*/
import customer from './customer'
import employee from './employee'
import test from './test'
import product from './product'
import setting from './setting'

// Array of sections,
export default [...customer, ...employee, ...product, ...setting, ...test]
