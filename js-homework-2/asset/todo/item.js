export class Item
{
	title;
	deleteButtonHandler;
	editButtonHandler;

	constructor({title, deleteButtonHandler})
	{
		this.title = String(title);
		if (typeof deleteButtonHandler === 'function')
		{
			this.deleteButtonHandler = deleteButtonHandler;
		}
	}

	getData()
	{
		return {title: this.title};
	}

	render()
	{
		const container = document.createElement('div');
		container.classList.add('item-container');
		const title = document.createElement('div');
		title.classList.add('item-title');
		title.innerText = this.title;
		container.append(title);

		const buttonsContainer = document.createElement('div');
		const deleteButton = document.createElement('button');
		deleteButton.setAttribute('class', 'btn-delete')
		deleteButton.innerText = 'Delete';
		buttonsContainer.append(deleteButton);
		deleteButton.addEventListener('click', this.handleDeleteButtonClick.bind(this));

		// container.append(buttonsContainer);

		const editButton = document.createElement('button');
		editButton.setAttribute('class', 'btn-edit')
		editButton.innerText = 'Edit';
		buttonsContainer.append(editButton);
		editButton.addEventListener('click', this.handleEditButtonClick.bind(this));

		container.append(buttonsContainer);

		return container;
	}

	handleDeleteButtonClick()
	{
		if (this.deleteButtonHandler)
		{
			this.deleteButtonHandler(this);
		}
	}

	contains(selector, text) {
	var elements = document.querySelectorAll(selector);
	return Array.prototype.filter.call(elements, function(element){
		return RegExp(text).test(element.textContent);
	});
}

	handleEditButtonClick()
	{
		document.querySelector('[class="calendar-new-item-title"]').value = this.title;

		const todoTags = document.getElementsByClassName("item-title");
		for (let i = 0; i < todoTags.length; i++) {
			if (todoTags[i].innerText === this.title) {
				todoTags[i].innerText = '***' + this.title + '***';
				break;
			}
		}
		this.title = '***' + this.title + '***';
		document.querySelector('[class="btn-add"]').innerText = 'Modify';
	}

}