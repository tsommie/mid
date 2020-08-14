import Index from '../views/user/Index'
import ShowRouter from '../views/user/ShowRouter'
import Show from '../views/user/Show'
import Edit from '../views/user/Edit'
import Create from '../views/user/Create'
import Trash from "../views/user/Trash";

export const user = [
  {
    path: '/deleted/users',
    name: 'users.deleted',
    component: Trash
  },

  {
    path: '/users',
    name: 'users.index',
    component: Index
  },
  {
    path: '/users/create',
    name: 'users.create',
    component: Create
  },
  {
    path: '/users/:userId',
    component: ShowRouter,
    children: [
      {
        path: '',
        name: 'users.show',
        component: Show,
      },
      {
        path: 'edit',
        name: 'users.edit',
        component: Edit,
      },
    ]
  },
]

export default user
