class Node:
    # ทำงานเมื่อสร้าง newnode
    def __init__(self, key):
        self.data = key
        self.Llink = None
        self.Rlink = None

# function insert newnode
def insert(root, data):
    # newnode
    p = Node(data)
    # checck :  tree ว่างมั้ยถ้าว่างเพิ่ม node p เข้าไป ในtree
    if root is None:
        return p
    
    curr = root # curr ชี้ ที่ root
    prev = None

    # search 
    # curr != NULL
    while curr is not None: 
        # ให้ prev, curr ชี้position เดียวกัน
        prev = curr 
        # p(new node) < curr -> เลื่อน curr ไปที่แขนซ้าย
        if p.data <curr.data :
            curr = curr.Llink
        else :
            # p(new node) > curr -> เลื่อน curr ไปที่แขนขวา
            curr = curr.Rlink
        pass
    # insert : newnode
    # p<prev -> เชื่อม node: p ที่แขนซ้าย
    if p.data < prev.data: 
        prev.Llink = p
    else :
        # p>prev -> เชื่อม node: p ที่แขนขวา
        prev.Rlink = p
    return root

# 1. Pre-order: [Root] -> [Left] -> [Right]
def pre_order(root):
    if root:
        print(root.data, end=" ") # พิมพ์พ่อก่อน
        pre_order(root.Llink)      # แล้วค่อยไปซ้าย
        pre_order(root.Rlink)      # แล้วค่อยไปขวา

# 2. In-order: [Left] -> [Root] -> [Right]
def in_order(root):
    if root:
        in_order(root.Llink)       # ไปซ้ายสุดก่อน (ค่าน้อยสุด)
        print(root.data, end=" ")  # พิมพ์ค่าปัจจุบัน
        in_order(root.Rlink)       # แล้วค่อยไปขวา
        
# 3. Post-order: [Left] -> [Right] -> [Root]
def post_order(root):
    if root:
        post_order(root.Llink)     # ไปซ้าย
        post_order(root.Rlink)     # ไปขวา
        print(root.data, end=" ")  # พิมพ์พ่อทีหลังสุด

# ใช้ข้อมูลชุดเดิมของคุณ [500, 300, 700, 200, 400]
inventory_root = None
prices = [500, 300, 700, 200 , 400]
for p in prices:
    inventory_root = insert(inventory_root, p)
    
print("--- ผลการท่อง Tree ทั้ง 3 แบบ ---")
print("Pre-order  :", end=" ")
pre_order(inventory_root)
print("\nIn-order   :", end=" ")
in_order(inventory_root)
print("\nPost-order :", end=" ")
post_order(inventory_root)