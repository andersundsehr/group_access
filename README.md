# EXT:group_access

> [!IMPORTANT]
> **TYPO3 v14:** TYPO3 now provides native authorization for Extbase controller actions via the `#[Authorize]` attribute, including frontend user group checks with `requireGroups`. For TYPO3 v14 projects, we recommend using this built-in feature instead of this extension. See the [TYPO3 Core documentation for Feature #107826](https://docs.typo3.org/permalink/changelog:feature-107826-1766220191) for details and examples. This extension remains useful for projects that need the same functionality on TYPO3 v13.

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

