# EXT:group_access


## install

`composer req andersundsehr/group_access:^1`

## usage:

````php
<?php

#[GroupAccess([2, 6])]
class CustomerController extends ActionController
{

    public function overviewAction(): ResponseInterface
    {
        //this action is only accessible if the Frontend User has group 2 or 6
    }
    
    #[GroupAccess([7])]
    public function listAction(): ResponseInterface
    {
        //this action is only accessible if the Frontend User has group (2 or 6) and 7
    }
}
````

````php
<?php

class ProjectController extends ActionController
{

    public function overviewAction(): ResponseInterface
    {
        //this action is only accessible for all users and without user login
    }
    
    #[GroupAccess([7, 9, 12])]
    public function listAction(): ResponseInterface
    {
        //this action is only accessible if the Frontend User has group 7 or 9 or 12
    }

    #[GroupAccess([3])]
    #[GroupAccess([5])]
    public function listAction(): ResponseInterface
    {
        //this action is only accessible if the Frontend User has group 3 and 5
    }
}
````

# with ♥️ from anders und sehr GmbH

> If something did not work 😮  
> or you appreciate this Extension 🥰 let us know.

> We are hiring https://www.andersundsehr.com/karriere/

