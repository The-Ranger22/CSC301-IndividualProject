class PriorityQueue{
    constructor() {
        this.items = [];
        this.size = 0;
    }
    enQ(item, priority){
        let qElement = new QueueElement(item, priority);

    }
    deQ(){}
    frontQ(){}
    isEmpty(){}
    printQueue(){}


}
class QueueElement{

    constructor(element, priority) {
        this.element = element;
        this.priority = priority;
    }

    get getPriority() {
        return this.priority;
    }
    set setPriority(value) {
        this.priority = value;
    }
    get getElement() {
        return this.element;
    }
    set setElement(value) {
        this.element = value;
    }
}