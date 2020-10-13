class TimestampPriorityQueue{

    constructor() {
        this._elements = [];
    }
    enQ(item, priority){
        this._elements.push(new PriorityQueueElement(item, priority));
        let currentIndex = this.size() - 1;
        while(currentIndex > 0){
            console.log("currentIndex: " + currentIndex);
            let parentIndex = Math.floor((currentIndex - 1) / 2);
            console.log("parentIndex: " + parentIndex);
            if(TimestampPriorityQueue.compareTimestamps(this._elements[currentIndex].priority, this._elements[parentIndex].priority)){
                let temp = this._elements[currentIndex];
                this._elements[currentIndex] = this._elements[parentIndex];
                this._elements[parentIndex] = temp;
            } else {
                break;
            }
            currentIndex = parentIndex;
        }

    }
    deQ(){
        if(this.size() == 0) return null;

        let root = this.peek();
        this._elements[0] = this._elements[this.size() - 1];
        this._elements.pop();

        let currentIndex = 0;

        while(currentIndex < this.size()){
            let leftChildIndex = 2 * currentIndex + 1;
            let rightChildIndex = 2 * currentIndex + 2;

            if(leftChildIndex >= this.size()) break;
            let maxIndex = leftChildIndex;
            if(rightChildIndex < this.size()){
                if(TimestampPriorityQueue.compareTimestamps(this._elements[rightChildIndex].priority, this._elements[maxIndex].priority)){
                    maxIndex = rightChildIndex;
                }
            }

            if(TimestampPriorityQueue.compareTimestamps(this._elements[maxIndex].priority, this._elements[currentIndex].priority)){
                let temp = this._elements[maxIndex];
                this._elements[maxIndex] = this._elements[currentIndex];
                this._elements[currentIndex] = temp;
                currentIndex = maxIndex;
            }
            else{
                break;
            }
        }
        return root.element;
    }
    isEmpty(){
        return this._elements.length == 0;
    }
    peek(){
        return this._elements[0];
    }
    size(){
        return this._elements.length;
    }
    clear(){
        this._elements = [];
    }

    static compareTimestamps(ts1, ts2){
        return (new Date(ts1) > new Date(ts2));
    }

    get elements() {
        return this._elements;
    }

    set elements(value) {
        this._elements = value;
    }

}
class PriorityQueueElement{
    constructor(element, priority) {
        this._element = element;
        this._priority = priority;
    }

    get priority() {
        return this._priority;
    }
    set priority(value) {
        this._priority = value;
    }
    get element() {
        return this._element;
    }
    set element(value) {
        this._element = value;
    }
}