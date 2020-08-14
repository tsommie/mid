import ShowRouter from '../views/organization/ShowRouter'
import Show from '../views/organization/Show'
import Index from '../views/organization/Index'
import Edit from '../views/organization/Edit'
import Trash from '../views/organization/Trash'
import Create from '../views/organization/Create'

export const organization = [
  {
    path: '/deleted/organizations',
    name: 'organizations.deleted',
    component: Trash
  },

  {
    path: '/organizations',
    name: 'organizations.index',
    component: Index
  },

  {
    path: '/organizations/create',
    name: 'organizations.create',
    component: Create
  },
  {
    path: '/organizations/:organizationId',
    component: ShowRouter,
    children: [
      {
        path: '',
        name: 'organizations.show',
        component: Show,
      },
      {
        path: 'edit',
        name: 'organizations.edit',
        component: Edit,
      },
    ]
  },
]

export default organization
