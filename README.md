# Magexo test project

New module for evidence Point Of Sale (aka POS)
Goal: is to create administration grid with ability to add new Point Of Sale then on front end list these POS in a simple list.

1. [x] Create new custom POS entity
    1. [x] DB Table pos_entity Fields: pos_id, name, address, is_available (bool)
    2. [x] generate some random POS in table “Point Of Sale 1”, “Point oOf Sale 2", ... “Point Of Sale 100”
2. [x] In Admin Panel add new CRUD Grid with list of Point Of Sale
    1. [x] Add new menu Item “Point Of Sale” into the Content menu.
    2. [x] Grid fields: POS Id, Name, Address, Is Availaible
    3. [x] Functions Create, Update and Delete
3. [x] Create console command to add new POS
    1. [x] Add new console command magexo:pos:add with parameters: name, address and is_availaible

## How to start

1. Clone this repo
2. Run ```bin/setup-existing```
3. Wait for setup to finish and open the site, or open [magexo.site/admin](https://magexo.site/admin)
4. Login as john.smith:password123
5. Go to Point Of Sale
6. Check the functionality in Admin
7. Check the functionality of command by running ```bin/magento magexo:pos:add "Point Of Sale from command" "Address  from command" 0```
8. ???
9. Profit

## Built using / Credits

- [markshust/docker-magento](https://github.com/markshust/docker-magento)
- [Adobe DevDocs](https://devdocs.magento.com/)
- [Mageplaza tutorial](https://www.mageplaza.com/magento-2-module-development)


### Remarks/Thoughts/Questions/Talk

- Is the generated code(like default factory) only generated after referenced in code(constructor, etc.) and not beforehand? Seems kinda stupid to rely on something that does not exist yet.
- Symfony commands, nice! Atleast something familiar :)
- Working with so many XMLs is new for me, took me a good while to figure out.
- Search in admin grid is not working, didn't have the strength to figure out why exactly. Stackoverflow says it is because of missing index but the index on name is present in the table.
- Normally(in prod environment), files like env.php and config.php would not be stored plainly in git. Some kinda of secure sotrage(vault, protected zip, git secret, etc.) would be used.
